import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'theme.dart';
import 'header.dart';

class DetailPage extends StatelessWidget {
  final Map<String, dynamic> laporan;
  const DetailPage({super.key, required this.laporan});

  @override
  Widget build(BuildContext context) {
    return BaseLayout(
      showBackButton: true,
      headerTitle: 'Detail Laporan',
      child: Padding(
        padding: const EdgeInsets.all(24),
        child: Container(
          padding: const EdgeInsets.all(16),
          decoration: BoxDecoration(color: Colors.white, borderRadius: BorderRadius.circular(16)),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            mainAxisSize: MainAxisSize.min,
            children: [
              Text('LAP-${laporan['id_laporan']}', style: GoogleFonts.plusJakartaSans(fontSize: 16, fontWeight: FontWeight.bold, color: AppTheme.primaryPink)),
              const Divider(height: 20),
              Text('Kategori: ${laporan['kategori'] ?? '-'}'),
              const SizedBox(height: 8),
              Text('Tanggal: ${laporan['tanggal_kejadian'] ?? '-'}'),
              const SizedBox(height: 8),
              Text('Lokasi: ${laporan['lokasi_kejadian'] ?? '-'}'),
              const SizedBox(height: 8),
              Text('Kronologi:\n${laporan['kronologi'] ?? '-'}'),
            ],
          ),
        ),
      ),
    );
  }
}