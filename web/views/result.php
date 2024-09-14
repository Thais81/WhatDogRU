<div class="resultBox">
    <h1><?php echo htmlspecialchars($breed->getbreedName()); ?></h1>
    <h2>vos caractéristiques:</h2>
    <?php if ($features) ?>
    <?php foreach ($features as $feature) : ?>
        <div class="featureItem">
            <p><?php echo htmlspecialchars($feature->getfeatureContent()); ?></p>
            <p><?php echo htmlspecialchars($feature->getfeaturerate()); ?> €</p>
        </div>
    <?php endforeach; ?>
    <button id="bye">Quitter</button>