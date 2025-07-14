const Header = () => {
  return (
    <header className="flex items-center justify-between p-4 bg-white shadow-md">
      <div className="flex items-center space-x-2">
        <img src="/DupaMallLogo.png" alt="DUPAMALL logo" className="w-10 h-10 object-contain"/>
        <h2 className="text-xl font-bold">DUPAMALL</h2>
      </div>
      <input
        type="text"
        placeholder="Search for products..."
        className="search-bar border border-gray-300 rounded px-4 py-1 w-1/2"/>
      <div className="text-2xl">👤</div>
    </header> 
  );
};

export default Header;
