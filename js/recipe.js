function submitRecipe() {
    // Get values from the form
    var recipeName = document.getElementById('recipeName').value;
    var ingredients = document.getElementById('ingredients').value;
    var instructions = document.getElementById('instructions').value;

    // Display the recipe
    document.getElementById('outputName').textContent = recipeName;
    document.getElementById('outputIngredients').textContent = ingredients;
    document.getElementById('outputInstructions').textContent = instructions;

    // Show the recipe output section
    document.getElementById('recipeOutput').classList.remove('hidden');
}
