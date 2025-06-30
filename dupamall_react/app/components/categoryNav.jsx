//list of categories
const categories = ['Electronics','Clothes','Food','Services'];

const CategoryNav = () =>{
    return(
        <nav className="category-nav">
            {categories.map((category,index) => (
                <div key={index} className="category-item">
                    {category}
                </div>
            ))}

        </nav>
    );
};

export default CategoryNav;