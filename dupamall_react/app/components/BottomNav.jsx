const BottomNav = () => {
  return (
    <nav className="fixed bottom-0 left-0 w-full bg-white border-t shadow-sm flex justify-around items-center py-2 z-50">
      <button className="text-sm text-center">🏠<br />Home</button>
      <button className="text-sm text-center">🛍️<br />Stores</button>
      <button className="text-sm text-center">🧺<br />Book</button>
      <button className="text-sm text-center">👤<br />Profile</button>
    </nav>
  );
};

export default BottomNav;
