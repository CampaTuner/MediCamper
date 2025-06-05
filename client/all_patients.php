<?php
$query = "SELECT * FROM patients";
$result = mysqli_query($conn, $query);

?>
<div class="container py-5">
    <h2 class="text-center text-primary mb-4">Our Patients</h2>

    <div class="row">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 rounded-4 " style="height: 350px;">
                    <?php if (!empty($row['p_avatar'])): ?>
                        <img src="./server/uploads/<?= $row['p_avatar'] ?>" class="card-img-top rounded-top-4" style="height:250px; object-fit:cover;" alt="Doctor Image">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title text-primary"><?= htmlspecialchars($row['p_username']) ?></h5>
                        <p class="card-text">
                            <strong>Email:</strong> <?= htmlspecialchars($row['p_email']) ?><br>
                        </p>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>