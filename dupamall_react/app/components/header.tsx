import React from "react";

const Header = () => {
    return (
        <header className="header">
            <img src="/public/dupamall.png" alt="" />
            <h1>DUPAMALL</h1>
            <input type="text" placeholder="Search for products or services..." className="search-bar"/>
            <div className="user-icon">👤</div>
            
        </header>
    );
}

export default Header;