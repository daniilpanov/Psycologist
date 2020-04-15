<?php
/** @var $result bool */
/** @var $from string|null */
/** @var $spec_msg string|null */

if ($result)
{
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
    echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button>";

    if (!isset($spec_msg))
        echo "<h4 class='alert-heading'>This operation was doing <strong>successfully!</strong></h4>";
    else
        echo "<h4 class='alert-heading'>$spec_msg</h4>";

    if ($from !== null)
        echo "<p><a class='alert-link go-back' href='$from'>Go back</a>";

    echo "</div>";
}
else
{
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>";
    echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
    <span aria-hidden=\"true\">&times;</span>
  </button>";

    if (!isset($spec_msg))
        echo "<h4 class='alert-heading'>This operation was doing <strong>with unknown error!</strong></h4>";
    else
        echo "<h4 class='alert-heading'>$spec_msg</h4>";

    if ($from !== null)
        echo "<p><a class='alert-link go-back' href='$from'>Go back</a>";

    echo "</div>";
}