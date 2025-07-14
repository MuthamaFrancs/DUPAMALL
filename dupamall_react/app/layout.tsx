import type { Metadata } from "next";
import { Inter } from "next/font/google";
import "./globals.css";
import Header from "./components/Header";

const inter = Inter({ subsets: ["latin"] });

export const metadata: Metadata = {
  title: "DUPAMALL - Campus Marketplace",
  description: "Your one-stop shop for campus essentials and services.",
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="en">
      <body className={inter.className} style={{ margin: 0, padding: 0 }}>
        <Header /> 
        <main style={{ minHeight: 'calc(100vh - 100px)', paddingTop: '60px' }}>
          {children}    
        </main>
        <footer style={{ background: '#333', color: 'white', textAlign: 'center', padding: '20px' }}>
        <p>&copy; {new Date().getFullYear()} DUPAMALL</p>
        </footer>
      </body>
    </html>
  );
}