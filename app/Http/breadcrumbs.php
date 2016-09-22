<?php

// Home
Breadcrumbs::register('dashboard', function($breadcrumbs)
{
    $breadcrumbs->push('Home', route('dashboard'));
});


//Container

Breadcrumbs::register('admin.container.index', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Container', route('admin.container.index'));
});
Breadcrumbs::register('admin.container.create', function($breadcrumbs)
{
    $breadcrumbs->parent('admin.container.index');
    $breadcrumbs->push('Add', route('admin.container.create'));
});

Breadcrumbs::register('admin.container.edit', function($breadcrumbs, $Container)
{
    $breadcrumbs->parent('admin.container.index');
    $breadcrumbs->push("Edit ".$Container->container_name, route('admin.container.edit', $Container->id));
});


//Course

Breadcrumbs::register('admin.course.index', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Course', route('admin.course.index'));
});
Breadcrumbs::register('admin.course.create', function($breadcrumbs)
{
    $breadcrumbs->parent('admin.course.index');
    $breadcrumbs->push('Add', route('admin.course.create'));
});

Breadcrumbs::register('admin.course.edit', function($breadcrumbs, $course)
{
    $breadcrumbs->parent('admin.course.index');
    $breadcrumbs->push("Edit ".$course->course_name, route('admin.course.edit', $course->id));
});

//Taste

Breadcrumbs::register('admin.taste.index', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Taste', route('admin.taste.index'));
});
Breadcrumbs::register('admin.taste.create', function($breadcrumbs)
{
    $breadcrumbs->parent('admin.taste.index');
    $breadcrumbs->push('Add', route('admin.taste.create'));
});

Breadcrumbs::register('admin.taste.edit', function($breadcrumbs, $taste)
{
    $breadcrumbs->parent('admin.taste.index');
    $breadcrumbs->push("Edit ".$taste->taste_name, route('admin.taste.edit', $taste->id));
});

//Alergie

Breadcrumbs::register('admin.allergies.index', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Allergies', route('admin.allergies.index'));
});
Breadcrumbs::register('admin.allergies.create', function($breadcrumbs)
{
    $breadcrumbs->parent('admin.allergies.index');
    $breadcrumbs->push('Add', route('admin.allergies.create'));
});

Breadcrumbs::register('admin.allergies.edit', function($breadcrumbs, $allergies)
{
    $breadcrumbs->parent('admin.allergies.index');
    $breadcrumbs->push("Edit ".$allergies->allergies_name, route('admin.allergies.edit', $allergies->id));
});

//Events

Breadcrumbs::register('admin.events.index', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Events', route('admin.events.index'));
});
Breadcrumbs::register('admin.events.create', function($breadcrumbs)
{
    $breadcrumbs->parent('admin.events.index');
    $breadcrumbs->push('Add', route('admin.events.create'));
});

Breadcrumbs::register('admin.events.edit', function($breadcrumbs, $events)
{
    $breadcrumbs->parent('admin.events.index');
    $breadcrumbs->push("Edit ".$events->event_name, route('admin.events.edit', $events->id));
});

//Diet Option

Breadcrumbs::register('admin.dietoption.index', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('dietoption', route('admin.dietoption.index'));
});
Breadcrumbs::register('admin.dietoption.create', function($breadcrumbs)
{
    $breadcrumbs->parent('admin.dietoption.index');
    $breadcrumbs->push('Add', route('admin.dietoption.create'));
});

Breadcrumbs::register('admin.dietoption.edit', function($breadcrumbs, $DietOption)
{
    $breadcrumbs->parent('admin.dietoption.index');
    $breadcrumbs->push("Edit ".$DietOption->dietoption_name, route('admin.dietoption.edit', $DietOption->id));
});

//Cuisine

Breadcrumbs::register('admin.cuisine.index', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Cuisine', route('admin.cuisine.index'));
});
Breadcrumbs::register('admin.cuisine.create', function($breadcrumbs)
{
    $breadcrumbs->parent('admin.cuisine.index');
    $breadcrumbs->push('Add', route('admin.cuisine.create'));
});

Breadcrumbs::register('admin.cuisine.edit', function($breadcrumbs, $cuisine)
{
    $breadcrumbs->parent('admin.cuisine.index');
    $breadcrumbs->push("Edit ".$cuisine->cuisine_name, route('admin.cuisine.edit', $cuisine->id));
});

//Cuisine

Breadcrumbs::register('admin.mealtime.index', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Mealtime', route('admin.mealtime.index'));
});
Breadcrumbs::register('admin.mealtime.create', function($breadcrumbs)
{
    $breadcrumbs->parent('admin.mealtime.index');
    $breadcrumbs->push('Add', route('admin.mealtime.create'));
});

Breadcrumbs::register('admin.mealtime.edit', function($breadcrumbs, $mealtime)
{
    $breadcrumbs->parent('admin.mealtime.index');
    $breadcrumbs->push("Edit ".$mealtime->mealtime_name, route('admin.mealtime.edit', $mealtime->id));
});

//Cuisine

Breadcrumbs::register('admin.people.index', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('People', route('admin.people.index'));
});
Breadcrumbs::register('admin.people.create', function($breadcrumbs)
{
    $breadcrumbs->parent('admin.people.index');
    $breadcrumbs->push('Add', route('admin.people.create'));
});

Breadcrumbs::register('admin.people.edit', function($breadcrumbs, $people)
{
    $breadcrumbs->parent('admin.people.index');
    $breadcrumbs->push("Edit ".$people->people_name, route('admin.people.edit', $people->id));
});

//Cuisine

Breadcrumbs::register('admin.ingrediants.index', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Ingrediants', route('admin.ingrediants.index'));
});
Breadcrumbs::register('admin.ingrediants.create', function($breadcrumbs)
{
    $breadcrumbs->parent('admin.ingrediants.index');
    $breadcrumbs->push('Add', route('admin.ingrediants.create'));
});

Breadcrumbs::register('admin.ingrediants.edit', function($breadcrumbs, $ingrediants)
{
    $breadcrumbs->parent('admin.ingrediants.index');
    $breadcrumbs->push("Edit ".$ingrediants->ingrediant_name, route('admin.ingrediants.edit', $ingrediants->id));
});

//Food

Breadcrumbs::register('admin.food.index', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Food', route('admin.food.index'));
});
Breadcrumbs::register('admin.food.create', function($breadcrumbs)
{
    $breadcrumbs->parent('admin.food.index');
    $breadcrumbs->push('Add', route('admin.food.create'));
});

Breadcrumbs::register('admin.food.edit', function($breadcrumbs, $food)
{
    $breadcrumbs->parent('admin.food.index');
    $breadcrumbs->push("Edit ".$food->food_name, route('admin.food.edit', $food->id));
});

//Media

Breadcrumbs::register('admin.media.index', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Media', route('admin.media.index'));
});
Breadcrumbs::register('admin.media.create', function($breadcrumbs)
{
    $breadcrumbs->parent('admin.media.index');
    $breadcrumbs->push('Add', route('admin.media.create'));
});

Breadcrumbs::register('admin.media.edit', function($breadcrumbs, $media)
{
    $breadcrumbs->parent('admin.media.index');
    $breadcrumbs->push("Edit ".$media->media, route('admin.media.edit', $media->id));
});

//Resource Type

Breadcrumbs::register('admin.resourcetype.index', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Resourcetype', route('admin.resourcetype.index'));
});
Breadcrumbs::register('admin.resourcetype.create', function($breadcrumbs)
{
    $breadcrumbs->parent('admin.resourcetype.index');
    $breadcrumbs->push('Add', route('admin.resourcetype.create'));
});

Breadcrumbs::register('admin.resourcetype.edit', function($breadcrumbs, $resourcetype)
{
    $breadcrumbs->parent('admin.resourcetype.index');
    $breadcrumbs->push("Edit ".$resourcetype->resource_type, route('admin.resourcetype.edit', $resourcetype->id));
});

//Food Allergy

Breadcrumbs::register('admin.foodallergies.index', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Foodallergy', route('admin.foodallergies.index'));
});
Breadcrumbs::register('admin.foodallergies.create', function($breadcrumbs)
{
    $breadcrumbs->parent('admin.foodallergies.index');
    $breadcrumbs->push('Add', route('admin.foodallergies.create'));
});

Breadcrumbs::register('admin.foodallergies.edit', function($breadcrumbs, $foodallergies)
{
    $breadcrumbs->parent('admin.foodallergies.index');
    $breadcrumbs->push("Edit ".$foodallergies->food_name, route('admin.foodallergies.edit', $foodallergies->id));
});

//End Product
?>
