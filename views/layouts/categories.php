<?php

/*<label>Categories</label>
<div class="mb-3">
    <?php

    ?>
    <select name="category_id" id="category_id" class="form-control" value="<?php echo $params->categories; ?>">
        <?php
        if ($params !== null && $params->categories !== null) {
            foreach ($params->categories as $category) {
                $id = $category["id"];
                $name = $category["Name"];
                if ($params->categories_id == $id) {
                    echo "<option value='$id' selected='selected'>$name</option>";
                } else {
                    echo "<option value='$id'>$name</option>";
                }
            }
        }
        ?>
    </select>
    <?php
    if ($params !== null && $params->errors !== null)
    {
        foreach ($params->errors as $objectNum => $item) {
            if ($objectNum == "categories_id")
            {
                echo "<span class='text-danger'>$item[0]</span>";
            }
        }

?>
<label>Categories</label>
<div class="mb-3">*/


?>