<aside id="slide-out" class="side-nav white fixed">
    <div class="side-nav-wrapper">

        <div class="sidebar-profile">

            <div class="sidebar-profile-image center-align">
                <img src="assets/images/profile-image.png" class="circle" alt="">
            </div>

            <hr color="gray" size="0.5px">

            <div class="sidebar-profile-info center-align style-none">
                
                <?php
                $eid = $_SESSION['eid'];
                $sql = "SELECT FirstName,LastName,EmpId from  tblemployees where id=:eid";
                $query = $dbh->prepare($sql);
                $query->bindParam(':eid', $eid, PDO::PARAM_STR);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                $cnt = 1;
                if ($query->rowCount() > 0) {
                    foreach ($results as $result) { ?>

                        <p style="font-family: Lilita One; font-size: 18px;">
                            <?php echo htmlentities($result->FirstName . " " . $result->LastName); ?>
                        </p>
                        <span>
                            <?php echo htmlentities($result->EmpId) ?>
                        </span>

                    <?php }
                } ?>
            </div>
        </div>

        <ul class="sidebar-menu collapsible collapsible-accordion" data-collapsible="accordion">

            <li class="no-padding">
                <a class="waves-effect waves-grey" href="emp-changepassword.php">
                    <i class="material-icons">
                        <img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABIAAAASCAYAAABWzo5XAAAACXBIWXMAAAsTAAALEwEAmpwYAAABcklEQVR4nL3SPciNYRjA8SOSSGIRMiglXwODIjyLc3Cu//96OulO76IsMjEoRillYqAsNrIwGBSTbEgWZSCZULL4SAwMeuq8dZKc56Fc033fV/26r49e739FRCxVz6i3gIsRsakzUtf1auCtegc4BlxWv2Rm6QQBN9Qrg8FgWWYer+t6c13XOzJzTyllfmtIfZ+ZW9TrwDPgc2buHufeqDNtoVcRsUu9oD5RT85iETEEPqjL20DngHvAQuD2BPaxKRd4BBycCgEHgB+Zua7pyRh7oX7LzJXq/Yg4NA3Z30xInRkOh+uB0/1+fxFwGNgJbB3n17RCMnMD8E59DTxVT6nn1U/qiT/1Zd9vkLNVVc1Tj6hXgUvNEKaV9PxXpNclgO3q2on7taaxpePibRyX0599i4hVwFe17vKbo+rjiNjW7EZE7AXuAg8zc3FraDQarQBeqt/Vm83uqA9KKUtaIxMxp6qqBc2hWftSyty/Qf45fgKZL62uRz7/gwAAAABJRU5ErkJggg==">
                    </i>Cambia la contraseña
                </a>
            </li>

            <li class="no-padding">
                <a class="waves-effect waves-grey" href="myprofile.php">
                    <i class="material-icons">account_box</i>Mi cuenta
                </a>
            </li>

            <li class="no-padding">
                <a class="collapsible-header waves-effect waves-grey">
                    <i class="material-icons">
                        <img
                            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABcAAAAXCAYAAADgKtSgAAAACXBIWXMAAAsTAAALEwEAmpwYAAABfklEQVR4nO2Uv0scQRiGN9EuQVvRBAWvFBFtUuUKPVhmnnf2CDeSPyGVbcprJBBJY2NrYRGwCYEkFmmChQgWIopFyoCI2AYiIhomzMGwHORuvS554S0Wvnm+H/PtZNl/9atGo/EIeAt8TS1pzXv/OLuPJK1LugI+AtuSvki6i97L83ykMhw4AN4nyWoRvCbpZ6UE1toJSa+BC2CzCxyg3ncC7/0ocAZcAzcp3BgzGeHLsbNOgm/e+6FeqjYBYK1dkHSYwtvt9kNJ3yVdJhf8I8SHRL3AWyE4z/MnZXhQURRTwEayObuxmFZluHNuPHTTsTFmLnQS4+4HB06SNfxj59zLgcCNMWPlyuv1+vBA4JJWS3/pZ2vtzKDG8qb0DOwA85XhwD5wJOlZOpLUwEqc//N+4a8k3ZYvsmzgU9icv8KBZjxUC9/NZnPaObeUGngXY15Ims2y7EHWi4qieCrpl6Tj8BJ2s6RzSac9AbtUvyjpQ/kdT7wVOqoEz/55/QboICxstwACLAAAAABJRU5ErkJggg==">
                    </i>Solicitud
                    <i class="nav-drop-icon material-icons">keyboard_arrow_right</i>
                </a>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="apply-leave.php">Solicitar permiso</a></li>
                        <li><a href="leavehistory.php">Ver el historial</a></li>
                    </ul>
                </div>
            </li>

            <li class="no-padding">
                <a class="waves-effect waves-grey" href="logout.php"><i
                        class="material-icons">exit_to_app</i>Desconectar</a>
            </li>


        </ul>
        <div class="footer">
            <p class="copyright"><a href="https://www.instagram.com/workfusionhr?igsh=MXNrMjZhZWQ3amdmag==">WorkFusion</a> ©</p>

        </div>
    </div>
</aside>