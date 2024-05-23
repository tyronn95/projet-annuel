import React, { useState } from 'react';

function AdminPanel() {
  const [formData, setFormData] = useState({
    name: '',
    tagline: '',
    description: '',
    image: '',
    id: ''
  });

  const handleChange = (e) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const baseUrl = 'http://localhost:5000'; // Base URL
      if (e.target.name === 'addBeerForm') {
        await fetch(`${baseUrl}/beers`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(formData)
        });
        console.log('Beer added successfully!');
      } else if (e.target.name === 'deleteBeerForm') {
        await fetch(`${baseUrl}/beers/${formData.id}`, {
          method: 'DELETE'
        });
        console.log('Beer deleted successfully!');
      } else if (e.target.name === 'updateBeerForm') {
        await fetch(`${baseUrl}/beers`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(formData)
        });
        console.log('Beer updated successfully!');
      }
    } catch (error) {
      console.error(error);
    }
  };

  return (
    <div>
      <h1>Admin Panel</h1>

      {/* Add Beer Form */}
      <form name="addBeerForm" onSubmit={handleSubmit}>
        <input type="text" name="name" placeholder="Name" value={formData.name} onChange={handleChange} required /><br />
        <input type="text" name="tagline" placeholder="Tagline" value={formData.tagline} onChange={handleChange} required /><br />
        <textarea name="description" placeholder="Description" value={formData.description} onChange={handleChange} required /><br />
        <input type="text" name="image" placeholder="Image URL" value={formData.image} onChange={handleChange} required /><br />
        <button type="submit">Add Beer</button>
      </form>

      {/* Delete Beer Form */}
      <form name="deleteBeerForm" onSubmit={handleSubmit}>
        <input type="number" name="id" placeholder="ID of beer to delete" value={formData.id} onChange={handleChange} required /><br />
        <button type="submit">Delete Beer</button>
      </form>

      {/* Update Beer Form */}
      <form name="updateBeerForm" onSubmit={handleSubmit}>
        <input type="number" name="id" placeholder="ID of beer to update" value={formData.id} onChange={handleChange} required /><br />
        <input type="text" name="name" placeholder="Name" value={formData.name} onChange={handleChange} /><br />
        <input type="text" name="tagline" placeholder="Tagline" value={formData.tagline} onChange={handleChange} /><br />
        <textarea name="description" placeholder="Description" value={formData.description} onChange={handleChange} /><br />
        <input type="text" name="image" placeholder="Image URL" value={formData.image} onChange={handleChange} /><br />
        <button type="submit">Update Beer</button>
      </form>
    </div>
  );
}

export default AdminPanel;
