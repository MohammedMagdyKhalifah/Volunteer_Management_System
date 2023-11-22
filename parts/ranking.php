<div class="container my-4">
    <h1 class=" mb-4">Top 10 Volunteers in Volunteer Hours</h1>
    <div class="row">
        <?php $counter=1; ?>
        <?php foreach($volunteers as $volunteer): ?>
            <div class="col-md-4 d-flex align-items-stretch mb-4">
                <div class="card shadow-sm" style="width: 100%;">
                    <div class="card-header bg-success text-white">
                        <?php echo ordinal($counter) . " ".htmlspecialchars($volunteer['name']); ?>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Skills: <?php echo htmlspecialchars($volunteer['skills']);?></li>
                        <li class="list-group-item">Rate: <?php echo htmlspecialchars($volunteer['rate']);?></li>
                        <li class="list-group-item">Volunteer opportunity: <?php echo htmlspecialchars($volunteer['number_v']);?></li>
                        <li class="list-group-item ">Volunteering hours: <?php echo htmlspecialchars($volunteer['volunteering_hours']);?></li>
                    </ul>
                </div>
            </div>
            <?php $counter++; ?>
        <?php endforeach;?>
    </div>
</div>