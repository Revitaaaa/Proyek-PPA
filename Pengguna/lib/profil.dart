import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'theme.dart';
import 'header.dart';

class ProfilPage extends StatelessWidget {
  const ProfilPage({super.key});

  @override
  Widget build(BuildContext context) {
    return BaseLayout(
      showBackButton: false,
      headerTitle: 'Profil',
      child: Padding(
        padding: const EdgeInsets.all(24),
        child: Column(
          children: [
            const CircleAvatar(radius: 40, backgroundColor: Color(0xFFFFEEF2), child: Icon(Icons.person, size: 40, color: AppTheme.primaryPink)),
            const SizedBox(height: 12),
            Text('Revitaaa', style: GoogleFonts.plusJakartaSans(fontSize: 18, fontWeight: FontWeight.bold)),
            Text('revita@student.ac.id', style: GoogleFonts.plusJakartaSans(color: AppTheme.textGrey)),
          ],
        ),
      ),
    );
  }
}