import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:http/http.dart' as http;

class Register extends StatefulWidget {
  const Register({super.key});

  @override
  State<Register> createState() => _RegisterState();
}

class _RegisterState extends State<Register> {
  static const Color primaryPink = Color(0xFFE0245E);
  static const Color headerPink = Color(0xFFFF4B72);
  static const Color hintPink = Color(0xFFE9A1B7);

  final TextEditingController _namaController = TextEditingController();
  final TextEditingController _nikController = TextEditingController();
  final TextEditingController _tanggalController = TextEditingController();
  final TextEditingController _alamatController = TextEditingController();
  final TextEditingController _emailController = TextEditingController();
  final TextEditingController _noHpController = TextEditingController();
  final TextEditingController _passwordController = TextEditingController();
  final TextEditingController _konfirmasiPasswordController = TextEditingController();

  bool _obscurePassword = true;
  bool _obscureKonfirmasi = true;
  bool _isLoading = false;

  @override
  void dispose() {
    _namaController.dispose();
    _nikController.dispose();
    _tanggalController.dispose();
    _alamatController.dispose();
    _emailController.dispose();
    _noHpController.dispose();
    _passwordController.dispose();
    _konfirmasiPasswordController.dispose();
    super.dispose();
  }

  Future<void> _pilihTanggal() async {
    final DateTime? tanggal = await showDatePicker(
      context: context,
      initialDate: DateTime(2000),
      firstDate: DateTime(1940),
      lastDate: DateTime.now(),
    );

    if (tanggal != null) {
      setState(() {
        _tanggalController.text =
            '${tanggal.day.toString().padLeft(2, '0')}/'
            '${tanggal.month.toString().padLeft(2, '0')}/'
            '${tanggal.year}';
      });
    }
  }

  Future<void> _daftar() async {
    final nama = _namaController.text.trim();
    final nik = _nikController.text.trim();
    final tanggal = _tanggalController.text.trim();
    final alamat = _alamatController.text.trim();
    final email = _emailController.text.trim();
    final noHp = _noHpController.text.trim();
    final password = _passwordController.text;
    final konfirmasiPassword = _konfirmasiPasswordController.text;

    if (nama.isEmpty ||
        nik.isEmpty ||
        tanggal.isEmpty ||
        alamat.isEmpty ||
        email.isEmpty ||
        noHp.isEmpty ||
        password.isEmpty ||
        konfirmasiPassword.isEmpty) {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          content: Text('Semua data harus diisi!', style: GoogleFonts.plusJakartaSans()),
          backgroundColor: Colors.red,
        ),
      );
      return;
    }

    // Validasi NIK Wajib Angka dan Harus Tepat 16 Karakter
    if (nik.length != 16 || !RegExp(r'^[0-9]+$').hasMatch(nik)) {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          content: Text('NIK harus berupa angka dan harus tepat 16 digit!', style: GoogleFonts.plusJakartaSans()),
          backgroundColor: Colors.red,
        ),
      );
      return;
    }

    // Validasi Nomor HP Wajib Angka dan Harus Tepat 12 Karakter
    if (noHp.length != 12 || !RegExp(r'^[0-9]+$').hasMatch(noHp)) {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          content: Text('Nomor HP harus berupa angka dan harus tepat 12 digit!', style: GoogleFonts.plusJakartaSans()),
          backgroundColor: Colors.red,
        ),
      );
      return;
    }

    // Validasi Email Wajib Mengandung '@'
    if (!email.contains('@')) {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          content: Text('Format email tidak valid (harus mengandung "@")!', style: GoogleFonts.plusJakartaSans()),
          backgroundColor: Colors.red,
        ),
      );
      return;
    }

    // Validasi Password 3 - 7 Karakter
    if (password.length < 3 || password.length > 7) {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          content: Text('Password harus di antara 3 sampai 7 karakter!', style: GoogleFonts.plusJakartaSans()),
          backgroundColor: Colors.red,
        ),
      );
      return;
    }

    if (password != konfirmasiPassword) {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          content: Text('Konfirmasi password tidak sama.', style: GoogleFonts.plusJakartaSans()),
          backgroundColor: Colors.red,
        ),
      );
      return;
    }

    setState(() => _isLoading = true);

    try {
      final res = await http.post(
        Uri.parse('http://localhost:8000/api/register'),
        headers: {'Content-Type': 'application/json'},
        body: jsonEncode({
          'name': nama,
          'nik': nik,
          'tanggal_lahir': tanggal,
          'alamat': alamat,
          'email': email,
          'no_hp': noHp,
          'password': password,
        }),
      );

      setState(() => _isLoading = false);
      final data = jsonDecode(res.body);

      if (res.statusCode == 200 || res.statusCode == 201) {
        if (!mounted) return;
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text('Registrasi berhasil! Silakan login.', style: GoogleFonts.plusJakartaSans()),
            backgroundColor: Colors.green,
          ),
        );
        Future.delayed(const Duration(milliseconds: 800), () {
          if (mounted) Navigator.pop(context);
        });
      } else {
        if (!mounted) return;
        
        // Tangkap pesan error dari Laravel (termasuk deteksi email duplikat)
        String errorMessage = 'Registrasi gagal!';
        if (data.containsKey('errors') && data['errors'].containsKey('email')) {
          errorMessage = 'Email sudah terdaftar, gunakan email lain!';
        } else if (data.containsKey('message')) {
          errorMessage = data['message'];
        }

        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text(errorMessage, style: GoogleFonts.plusJakartaSans()),
            backgroundColor: Colors.red,
          ),
        );
      }
    } catch (e) {
      setState(() => _isLoading = false);
      if (!mounted) return;
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          content: Text('Kesalahan jaringan: $e', style: GoogleFonts.plusJakartaSans()),
          backgroundColor: Colors.red,
        ),
      );
    }
  }

  Widget _buildField({
    required String label,
    required String hint,
    required IconData icon,
    required TextEditingController controller,
    TextInputType? keyboardType,
    bool obscureText = false,
    Widget? suffixIcon,
    VoidCallback? onTap,
    int maxLines = 1,
  }) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(
          label,
          style: GoogleFonts.plusJakartaSans(
            fontSize: 10,
            color: primaryPink,
            fontWeight: FontWeight.bold,
          ),
        ),
        const SizedBox(height: 6),
        TextField(
          controller: controller,
          keyboardType: keyboardType,
          obscureText: obscureText,
          onTap: onTap,
          readOnly: onTap != null,
          maxLines: maxLines,
          style: GoogleFonts.plusJakartaSans(fontSize: 12),
          decoration: InputDecoration(
            hintText: hint,
            hintStyle: GoogleFonts.plusJakartaSans(
              fontSize: 9,
              color: hintPink,
            ),
            prefixIcon: Icon(
              icon,
              color: primaryPink,
              size: 18,
            ),
            suffixIcon: suffixIcon,
            contentPadding: const EdgeInsets.symmetric(
              horizontal: 12,
              vertical: 13,
            ),
            enabledBorder: OutlineInputBorder(
              borderRadius: BorderRadius.circular(6),
              borderSide: const BorderSide(color: headerPink),
            ),
            focusedBorder: OutlineInputBorder(
              borderRadius: BorderRadius.circular(6),
              borderSide: const BorderSide(color: primaryPink),
            ),
          ),
        ),
      ],
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.white,
      body: SafeArea(
        child: SingleChildScrollView(
          child: Column(
            children: [
              SizedBox(
                height: 175,
                child: Stack(
                  children: [
                    ClipPath(
                      clipper: RegisterHeaderClipper(),
                      child: Container(
                        height: 140,
                        width: double.infinity,
                        decoration: const BoxDecoration(
                          gradient: LinearGradient(
                            colors: [
                              Color(0xFFFF719B),
                              Color(0xFFFF3F78),
                            ],
                          ),
                        ),
                      ),
                    ),
                    Positioned(
                      left: 15,
                      top: 18,
                      child: Container(
                        width: 36,
                        height: 36,
                        decoration: BoxDecoration(
                          color: Colors.white.withOpacity(0.25),
                          shape: BoxShape.circle,
                        ),
                        child: IconButton(
                          padding: EdgeInsets.zero,
                          onPressed: () => Navigator.pop(context),
                          icon: const Icon(
                            Icons.arrow_back_ios_new,
                            color: Colors.white,
                            size: 17,
                          ),
                        ),
                      ),
                    ),
                    Positioned(
                      bottom: 0,
                      left: 0,
                      right: 0,
                      child: Center(
                        child: Container(
                          width: 68,
                          height: 68,
                          decoration: BoxDecoration(
                            color: Colors.white,
                            shape: BoxShape.circle,
                            boxShadow: [
                              BoxShadow(
                                color: Colors.pink.withOpacity(0.2),
                                blurRadius: 10,
                                offset: const Offset(0, 5),
                              ),
                            ],
                          ),
                          child: const Icon(
                            Icons.handshake_outlined,
                            color: headerPink,
                            size: 36,
                          ),
                        ),
                      ),
                    ),
                  ],
                ),
              ),
              Padding(
                padding: const EdgeInsets.symmetric(horizontal: 25),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(
                      'Daftar Akun',
                      style: GoogleFonts.plusJakartaSans(
                        fontSize: 19,
                        fontWeight: FontWeight.bold,
                        color: primaryPink,
                      ),
                    ),
                    const SizedBox(height: 5),
                    Text(
                      'Buat akun baru untuk melaporkan kasus dan\nmemantau status laporan.',
                      style: GoogleFonts.plusJakartaSans(
                        fontSize: 11,
                        color: hintPink,
                        height: 1.4,
                      ),
                    ),
                    const SizedBox(height: 18),

                    _buildField(
                      label: 'Nama Lengkap',
                      hint: 'Masukkan nama lengkap',
                      icon: Icons.person_outline,
                      controller: _namaController,
                    ),
                    const SizedBox(height: 11),

                    _buildField(
                      label: 'Nomor Induk Keluarga (16 Angka)',
                      hint: 'Masukkan NIK',
                      icon: Icons.credit_card_outlined,
                      controller: _nikController,
                      keyboardType: TextInputType.number,
                    ),
                    const SizedBox(height: 11),

                    _buildField(
                      label: 'Tanggal Lahir',
                      hint: 'Pilih tanggal lahir',
                      icon: Icons.calendar_month_outlined,
                      controller: _tanggalController,
                      onTap: _pilihTanggal,
                      suffixIcon: const Icon(
                        Icons.calendar_today_outlined,
                        color: primaryPink,
                        size: 17,
                      ),
                    ),
                    const SizedBox(height: 11),

                    _buildField(
                      label: 'Alamat',
                      hint: 'Masukkan alamat lengkap',
                      icon: Icons.location_on_outlined,
                      controller: _alamatController,
                    ),
                    const SizedBox(height: 11),

                    _buildField(
                      label: 'Email (Wajib ada "@")',
                      hint: 'contoh@email.com',
                      icon: Icons.email_outlined,
                      controller: _emailController,
                      keyboardType: TextInputType.emailAddress,
                    ),
                    const SizedBox(height: 11),

                    _buildField(
                      label: 'Nomor HP (12 Angka)',
                      hint: '08123456789',
                      icon: Icons.phone_outlined,
                      controller: _noHpController,
                      keyboardType: TextInputType.phone,
                    ),
                    const SizedBox(height: 11),

                    _buildField(
                      label: 'Password (3 - 7 Karakter)',
                      hint: 'Masukkan password',
                      icon: Icons.lock_outline,
                      controller: _passwordController,
                      obscureText: _obscurePassword,
                      suffixIcon: IconButton(
                        icon: Icon(
                          _obscurePassword
                              ? Icons.visibility_off_outlined
                              : Icons.visibility_outlined,
                          color: headerPink,
                          size: 17,
                        ),
                        onPressed: () => setState(() => _obscurePassword = !_obscurePassword),
                      ),
                    ),
                    const SizedBox(height: 11),

                    _buildField(
                      label: 'Konfirmasi Password',
                      hint: 'Ulangi password',
                      icon: Icons.lock_outline,
                      controller: _konfirmasiPasswordController,
                      obscureText: _obscureKonfirmasi,
                      suffixIcon: IconButton(
                        icon: Icon(
                          _obscureKonfirmasi
                              ? Icons.visibility_off_outlined
                              : Icons.visibility_outlined,
                          color: headerPink,
                          size: 17,
                        ),
                        onPressed: () => setState(() => _obscureKonfirmasi = !_obscureKonfirmasi),
                      ),
                    ),
                    const SizedBox(height: 13),

                    SizedBox(
                      width: double.infinity,
                      height: 43,
                      child: ElevatedButton(
                        onPressed: _isLoading ? null : _daftar,
                        style: ElevatedButton.styleFrom(
                          backgroundColor: const Color(0xFFC92C5B),
                          foregroundColor: Colors.white,
                          elevation: 0,
                          shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(6),
                          ),
                        ),
                        child: _isLoading
                            ? const SizedBox(
                                width: 20,
                                height: 20,
                                child: CircularProgressIndicator(color: Colors.white, strokeWidth: 2),
                              )
                            : Text(
                                'Daftar',
                                style: GoogleFonts.plusJakartaSans(
                                  fontSize: 11,
                                  fontWeight: FontWeight.bold,
                                ),
                              ),
                      ),
                    ),
                    const SizedBox(height: 8),

                    Center(
                      child: Row(
                        mainAxisAlignment: MainAxisAlignment.center,
                        children: [
                          Text(
                            'Sudah punya akun? ',
                            style: GoogleFonts.plusJakartaSans(fontSize: 9, color: hintPink),
                          ),
                          GestureDetector(
                            onTap: () => Navigator.pop(context),
                            child: Text(
                              'Login',
                              style: GoogleFonts.plusJakartaSans(
                                fontSize: 9,
                                color: primaryPink,
                                fontWeight: FontWeight.bold,
                              ),
                            ),
                          ),
                        ],
                      ),
                    ),
                    const SizedBox(height: 18),
                  ],
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}

class RegisterHeaderClipper extends CustomClipper<Path> {
  @override
  Path getClip(Size size) {
    final path = Path();
    path.lineTo(0, size.height - 25);
    path.quadraticBezierTo(
      size.width * 0.25,
      size.height + 15,
      size.width * 0.5,
      size.height - 5,
    );
    path.quadraticBezierTo(
      size.width * 0.75,
      size.height - 25,
      size.width,
      size.height - 5,
    );
    path.lineTo(size.width, 0);
    path.close();
    return path;
  }

  @override
  bool shouldReclip(CustomClipper<Path> oldClipper) => false;
}