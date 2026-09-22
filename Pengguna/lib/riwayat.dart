import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:http/http.dart' as http;
import 'theme.dart';
import 'header.dart';
import 'detail.dart';

class RiwayatPage extends StatefulWidget {
  const RiwayatPage({super.key});

  @override
  State<RiwayatPage> createState() => _RiwayatPageState();
}

class _RiwayatPageState extends State<RiwayatPage> {
  List<dynamic> _list = [];
  bool _loading = true;

  @override
  void initState() {
    super.initState();
    _ambilRiwayat();
  }

  Future<void> _ambilRiwayat() async {
    setState(() => _loading = true);
    try {
      final res = await http.get(Uri.parse('${AppTheme.apiUrl}/riwayat'));
      if (res.statusCode == 200) {
        final data = jsonDecode(res.body);
        if (data['status'] == 'success') {
          setState(() {
            _list = data['data'];
            _loading = false;
          });
          return;
        }
      }
    } catch (_) {}
    setState(() => _loading = false);
  }

  Future<void> _hapus(int id) async {
    await http.delete(Uri.parse('${AppTheme.apiUrl}/laporan/$id'));
    _ambilRiwayat();
  }

  @override
  Widget build(BuildContext context) {
    return BaseLayout(
      showBackButton: false,
      headerTitle: 'Daftar Riwayat Laporan',
      headerAction: IconButton(icon: const Icon(Icons.refresh, color: Colors.white), onPressed: _ambilRiwayat),
      child: _loading
          ? const Center(child: CircularProgressIndicator(color: AppTheme.primaryPink))
          : _list.isEmpty
              ? Center(child: Text('Belum ada riwayat laporan.', style: GoogleFonts.plusJakartaSans(color: AppTheme.textGrey)))
              : ListView.builder(
                  padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 10),
                  itemCount: _list.length,
                  itemBuilder: (ctx, i) {
                    final item = _list[i];
                    final status = item['status_penanganan'] ?? 'Menunggu';
                    Color bg = AppTheme.badgeYellowBg;
                    Color txt = AppTheme.badgeYellowText;
                    if (status == 'Diproses') {
                      bg = AppTheme.badgeBlueBg;
                      txt = AppTheme.badgeBlueText;
                    } else if (status == 'Selesai') {
                      bg = AppTheme.badgeGreenBg;
                      txt = AppTheme.badgeGreenText;
                    }

                    return Container(
                      margin: const EdgeInsets.only(bottom: 10),
                      padding: const EdgeInsets.all(14),
                      decoration: BoxDecoration(color: Colors.white, borderRadius: BorderRadius.circular(14), border: Border.all(color: const Color(0xFFF0F0F2))),
                      child: Row(
                        children: [
                          Expanded(
                            child: InkWell(
                              onTap: () => Navigator.push(context, MaterialPageRoute(builder: (_) => DetailPage(laporan: item))),
                              child: Column(
                                crossAxisAlignment: CrossAxisAlignment.start,
                                children: [
                                  Text('LAP-${item['id_laporan']}', style: GoogleFonts.plusJakartaSans(color: AppTheme.primaryPink, fontWeight: FontWeight.bold, fontSize: 13)),
                                  Text(item['kategori'] ?? '', style: GoogleFonts.plusJakartaSans(fontWeight: FontWeight.w600, fontSize: 12)),
                                  Text(item['tanggal_kejadian'] ?? '', style: GoogleFonts.plusJakartaSans(fontSize: 10, color: AppTheme.textGrey)),
                                ],
                              ),
                            ),
                          ),
                          Container(
                            padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 4),
                            decoration: BoxDecoration(color: bg, borderRadius: BorderRadius.circular(6)),
                            child: Text(status, style: GoogleFonts.plusJakartaSans(color: txt, fontSize: 10, fontWeight: FontWeight.bold)),
                          ),
                          IconButton(
                            icon: const Icon(Icons.delete_outline, color: Colors.red, size: 20),
                            onPressed: () => _hapus(item['id_laporan']),
                          ),
                        ],
                      ),
                    );
                  },
                ),
    );
  }
}