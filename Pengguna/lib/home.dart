import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:http/http.dart' as http;
import 'theme.dart';
import 'header.dart';
import 'form1.dart';
import 'progres.dart';
import 'edukasi.dart';

class HomePage extends StatefulWidget {
  final Function(int) onTabChange;
  const HomePage({super.key, required this.onTabChange});

  @override
  State<HomePage> createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  Map<String, dynamic>? _laporanTerakhir;
  bool _isLoading = true;

  @override
  void initState() {
    super.initState();
    _ambilData();
  }

  Future<void> _ambilData() async {
    setState(() => _isLoading = true);
    try {
      final res = await http.get(Uri.parse('${AppTheme.apiUrl}/riwayat'));
      if (res.statusCode == 200) {
        final data = jsonDecode(res.body);
        if (data['status'] == 'success' && (data['data'] as List).isNotEmpty) {
          setState(() {
            _laporanTerakhir = data['data'][0];
            _isLoading = false;
          });
          return;
        }
      }
    } catch (_) {}
    setState(() {
      _laporanTerakhir = null;
      _isLoading = false;
    });
  }

  @override
  Widget build(BuildContext context) {
    return BaseLayout(
      showBackButton: false,
      child: ListView(
        padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 12),
        children: [
          // Kartu Sambutan
          Container(
            padding: const EdgeInsets.all(16),
            decoration: BoxDecoration(
              color: Colors.white,
              borderRadius: BorderRadius.circular(16),
              border: Border.all(color: const Color(0xFFF0F0F2)),
            ),
            child: Row(
              children: [
                Container(
                  width: 48,
                  height: 48,
                  decoration: BoxDecoration(
                    color: const Color(0xFFF1F3F6),
                    borderRadius: BorderRadius.circular(12),
                  ),
                  child: const Icon(Icons.person, color: AppTheme.primaryPink, size: 28),
                ),
                const SizedBox(width: 14),
                Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text('Selamat datang,', style: GoogleFonts.plusJakartaSans(fontSize: 12, color: AppTheme.textGrey)),
                    Text('Revitaaa', style: GoogleFonts.plusJakartaSans(fontSize: 17, fontWeight: FontWeight.bold, color: AppTheme.textDark)),
                    Text('Pengguna', style: GoogleFonts.plusJakartaSans(fontSize: 11, color: AppTheme.textGrey)),
                  ],
                ),
              ],
            ),
          ),
          const SizedBox(height: 16),

          // Tombol Buat Laporan
          InkWell(
            onTap: () async {
              final hasil = await Navigator.push(context, MaterialPageRoute(builder: (_) => const Form1Page()));
              if (hasil == true) _ambilData();
            },
            borderRadius: BorderRadius.circular(16),
            child: Container(
              padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 14),
              decoration: BoxDecoration(
                color: Colors.white,
                borderRadius: BorderRadius.circular(16),
                border: Border.all(color: const Color(0xFFF0F0F2)),
              ),
              child: Row(
                children: [
                  Container(
                    padding: const EdgeInsets.all(8),
                    decoration: BoxDecoration(
                      color: const Color(0xFFFFEEF2),
                      borderRadius: BorderRadius.circular(10),
                    ),
                    child: const Icon(Icons.assignment_outlined, color: AppTheme.primaryPink, size: 22),
                  ),
                  const SizedBox(width: 14),
                  Expanded(
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text('Buat Laporan', style: GoogleFonts.plusJakartaSans(fontWeight: FontWeight.bold, fontSize: 14, color: AppTheme.textDark)),
                        Text('Laporkan kejadian dengan aman', style: GoogleFonts.plusJakartaSans(fontSize: 11, color: AppTheme.textGrey)),
                      ],
                    ),
                  ),
                  const Icon(Icons.chevron_right, color: AppTheme.textGrey),
                ],
              ),
            ),
          ),
          const SizedBox(height: 24),

          // Status Laporan Terakhir
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              Text('Status Laporan Terakhir', style: GoogleFonts.plusJakartaSans(fontSize: 14, fontWeight: FontWeight.bold, color: AppTheme.textDark)),
              IconButton(icon: const Icon(Icons.refresh, size: 20, color: AppTheme.primaryPink), onPressed: _ambilData),
            ],
          ),
          const SizedBox(height: 10),
          _isLoading
              ? const Center(child: Padding(padding: EdgeInsets.all(16), child: CircularProgressIndicator(color: AppTheme.primaryPink)))
              : _laporanTerakhir == null
                  ? Container(
                      padding: const EdgeInsets.symmetric(vertical: 24),
                      decoration: BoxDecoration(color: Colors.white, borderRadius: BorderRadius.circular(16)),
                      child: Center(child: Text('Belum ada laporan aktif', style: GoogleFonts.plusJakartaSans(fontSize: 12, color: AppTheme.textGrey))),
                    )
                  : InkWell(
                      onTap: () => Navigator.push(context, MaterialPageRoute(builder: (_) => ProgresPage(laporan: _laporanTerakhir!))),
                      child: Container(
                        padding: const EdgeInsets.all(16),
                        decoration: BoxDecoration(color: Colors.white, borderRadius: BorderRadius.circular(16)),
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            Row(
                              mainAxisAlignment: MainAxisAlignment.spaceBetween,
                              children: [
                                Text('LAP-${_laporanTerakhir!['id_laporan']}', style: GoogleFonts.plusJakartaSans(fontWeight: FontWeight.bold, fontSize: 14, color: AppTheme.primaryPink)),
                                Text(_laporanTerakhir!['tanggal_kejadian'] ?? '', style: GoogleFonts.plusJakartaSans(fontSize: 11, color: AppTheme.textGrey)),
                              ],
                            ),
                            const SizedBox(height: 8),
                            Text(_laporanTerakhir!['kategori'] ?? '', style: GoogleFonts.plusJakartaSans(fontSize: 12, fontWeight: FontWeight.w600)),
                            const SizedBox(height: 8),
                            Container(
                              padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 4),
                              decoration: BoxDecoration(color: AppTheme.badgeYellowBg, borderRadius: BorderRadius.circular(6)),
                              child: Text(_laporanTerakhir!['status_penanganan'] ?? 'Menunggu Verifikasi', style: GoogleFonts.plusJakartaSans(color: AppTheme.badgeYellowText, fontSize: 11, fontWeight: FontWeight.bold)),
                            ),
                          ],
                        ),
                      ),
                    ),
          const SizedBox(height: 20),

          // Shortcut Bawah
          Row(
            children: [
              Expanded(
                child: InkWell(
                  onTap: () => widget.onTabChange(1),
                  child: Container(
                    padding: const EdgeInsets.symmetric(vertical: 18),
                    decoration: BoxDecoration(color: Colors.white, borderRadius: BorderRadius.circular(16)),
                    child: Column(
                      children: [
                        const Icon(Icons.history, color: AppTheme.primaryPink, size: 24),
                        const SizedBox(height: 6),
                        Text('Riwayat Laporan', style: GoogleFonts.plusJakartaSans(fontSize: 12, fontWeight: FontWeight.w600)),
                      ],
                    ),
                  ),
                ),
              ),
              const SizedBox(width: 14),
              Expanded(
                child: InkWell(
                  onTap: () => Navigator.push(context, MaterialPageRoute(builder: (_) => const EdukasiPage())),
                  child: Container(
                    padding: const EdgeInsets.symmetric(vertical: 18),
                    decoration: BoxDecoration(color: Colors.white, borderRadius: BorderRadius.circular(16)),
                    child: Column(
                      children: [
                        const Icon(Icons.menu_book_outlined, color: AppTheme.primaryPink, size: 24),
                        const SizedBox(height: 6),
                        Text('Informasi & Edukasi', style: GoogleFonts.plusJakartaSans(fontSize: 12, fontWeight: FontWeight.w600)),
                      ],
                    ),
                  ),
                ),
              ),
            ],
          ),
        ],
      ),
    );
  }
}