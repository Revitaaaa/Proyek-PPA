import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'theme.dart';

class WavyHeaderClipper extends CustomClipper<Path> {
  @override
  Path getClip(Size size) {
    Path path = Path();
    path.lineTo(0, size.height - 35);
    var p1 = Offset(size.width / 4, size.height);
    var e1 = Offset(size.width / 2, size.height - 20);
    path.quadraticBezierTo(p1.dx, p1.dy, e1.dx, e1.dy);

    var p2 = Offset(size.width * 0.75, size.height - 45);
    var e2 = Offset(size.width, size.height - 15);
    path.quadraticBezierTo(p2.dx, p2.dy, e2.dx, e2.dy);

    path.lineTo(size.width, 0);
    path.close();
    return path;
  }

  @override
  bool shouldReclip(CustomClipper<Path> oldClipper) => false;
}

class BaseLayout extends StatelessWidget {
  final Widget child;
  final bool showBackButton;
  final VoidCallback? onBack;
  final String? headerTitle;
  final Widget? headerAction;

  const BaseLayout({
    super.key,
    required this.child,
    this.showBackButton = false,
    this.onBack,
    this.headerTitle,
    this.headerAction,
  });

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: AppTheme.bgLight,
      body: Stack(
        children: [
          // 1. FORMULIR: Dimulai dari bawah lengkungan header (top: 175)
          SafeArea(
            child: Padding(
              padding: const EdgeInsets.only(top: 175),
              child: child,
            ),
          ),

          // 2. HEADER TETAP DI ATAS
          Positioned(
            top: 0,
            left: 0,
            right: 0,
            child: ClipPath(
              clipper: WavyHeaderClipper(),
              child: Container(
                height: 180, // Ditinggikan sedikit agar lebih proporsional
                width: double.infinity,
                color: AppTheme.headerPink,
                child: SafeArea(
                  bottom: false,
                  child: Padding(
                    padding: const EdgeInsets.symmetric(horizontal: 24, vertical: 12),
                    child: Column(
                      children: [
                        Row(
                          mainAxisAlignment: MainAxisAlignment.spaceBetween,
                          children: [
                            showBackButton
                                ? GestureDetector(
                                    onTap: onBack ?? () => Navigator.pop(context),
                                    child: Container(
                                      width: 36,
                                      height: 36,
                                      decoration: BoxDecoration(
                                        color: Colors.white.withOpacity(0.25),
                                        shape: BoxShape.circle,
                                      ),
                                      child: const Icon(Icons.chevron_left,
                                          color: Colors.white, size: 26),
                                    ),
                                  )
                                : const SizedBox(width: 36),
                            Row(
                              children: const [
                                Icon(Icons.notifications_none,
                                    color: Colors.white, size: 26),
                                SizedBox(width: 14),
                                CircleAvatar(
                                  radius: 16,
                                  backgroundColor: Colors.white,
                                  child: Icon(Icons.person,
                                      color: AppTheme.headerPink, size: 20),
                                ),
                              ],
                            ),
                          ],
                        ),
                        if (headerTitle != null) ...[
                          // Jarak ditambahkan agar tulisan judul turun ke bawah
                          const SizedBox(height: 14),
                          Row(
                            mainAxisAlignment: MainAxisAlignment.center,
                            children: [
                              Text(
                                headerTitle!,
                                style: GoogleFonts.plusJakartaSans(
                                  color: Colors.white,
                                  fontSize: 22, // Ukuran font dibuat lebih besar & tegas
                                  fontWeight: FontWeight.bold,
                                  letterSpacing: 0.3,
                                ),
                              ),
                              if (headerAction != null) ...[
                                const SizedBox(width: 8),
                                headerAction!,
                              ]
                            ],
                          ),
                        ],
                      ],
                    ),
                  ),
                ),
              ),
            ),
          ),
        ],
      ),
    );
  }
}