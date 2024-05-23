username = "jeannine";
password= "222008545";
Project name : Real Estate Listing Platform

Overview read me [5:21 PM, 5/2/2024] 
Welcome to real estate listing platform This is a real estate listing platform designed to connect buyers, sellers, and agents in the real estate market. Users can browse listings, filter properties based on their preferences, and connect with agents for further assistance.

 Role: Stores information about users who interact with the platform.
Features 
User ID 
Username
Email
Password (hashed)
First Name
Last Name
Phone Number
Registration Date
Listing Table:
Role: Represents individual listings of properties available for sale or rent.
Attributes:
Listing ID (Primary Key)
Property ID (Foreign Key)
Agent ID (Foreign Key)
Listing Type (sale/rent)
Price
Listing Date
Last Updated Date
Properties Table:
Role: Stores detailed information about each property.
Attributes:
Property ID (Primary Key)
Title
Description
Address
City
Bedrooms
Bathrooms
Square Footage
Year Built
Amenities (e.g., pool, gym, parking)
Agent Table:
Role: Stores information about real estate agents associated Users Table
user_id (PK): Unique identifier for each user.
username: Name or handle chosen by the user for identification.
email: Contact information for the user.
password: Securely stored for user authentication.
phone_number: Additional contact information.
account_type: Whether the user is a buyer, seller, or agent.
Listing Table
listing_id (PK): Unique identifier for each listing.
agent_id (FK): Foreign key referencing the agent who listed the property.
property_id (FK): Foreign key referencing the property being listed.
price: The price at which the property is listed.
status: Current status of the listing (e.g., active, pending, sold).
Properties Table
property_id (PK): Unique identifier for each property.
location_id (FK): Foreign key referencing the…
 Favorites Table
favorite_id (PK): Unique identifier for each favorite listing.
user_id (FK): Foreign key referencing the user who favorited the listing.
listing_id (FK): Foreign key referencing the listing that was favorited.
timestamp: Timestamp indicating when the listing was favo
user_id (FK): Foreign key referencing the user who wrote the review.
listing_id (FK): Foreign key referencing the listing being reviewed.
rating: Numeric rating given by the user for the listing.
comment: Optional text comment or review description.
timestamp: Timestamp indicating when the review was submitted.
[1:54 PM, 5/3/2024] Ndayisenga J Claude: Amenities Table
amenity_id (PK): Unique identifier for each amenity.
amenity_name: Name of the amenity (e.g., pool, gym, parking).
Buyer_ID (Primary Key)
Name
Email
Phone
Budget
Preferences (can be a JSON field storing various preferences like location, property type, number of bedrooms, etc.)
Seller Table:
Attributes:
Seller_ID (Primary Key)
Name
Email
Phone
Property_Address
Property_Type
Bedrooms
Bathrooms
Price
Description



