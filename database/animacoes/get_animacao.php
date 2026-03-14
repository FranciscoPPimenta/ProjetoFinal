<?php
require_once '../config.php';
session_start();


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $page = $_GET['page'];
    if (isset($_GET['nome'])) {
        $nome = $_GET['nome'];
        if (isset($_GET['desc'])) {
            $desc = $_GET['desc'];
            if (isset($_GET['ambito'])) {
                $ambito = $_GET['ambito'];
                if (isset($_GET['data'])) {
                    $data = $_GET['data'];
                    $sql = "SELECT * FROM animacoes WHERE id_animacao = ?";

                    if ($stmt = mysqli_prepare($conn, $sql)) {
                        // Bind the parameter to the statement
                        mysqli_stmt_bind_param($stmt, "i", $id);

                        // Execute the statement
                        mysqli_stmt_execute($stmt);

                        // Get the result
                        $result = mysqli_stmt_get_result($stmt);

                        if ($row = mysqli_fetch_assoc($result)) {
                            // Output the result (e.g., you can return the data as JSON or HTML)
                            $_SESSION["animacao_textura"] = $row['textura'];
                            $_SESSION["animacao_objeto"] = $row['objeto']; // Example field, adjust as per your table
                            $_SESSION["animacao_id"] = $row["id_animacao"];
                            $_SESSION["create_nome"] = $nome;
                            $_SESSION["create_desc"] = $desc;
                            $_SESSION["create_ambito"] = $ambito;
                            $_SESSION["create_data"] = $data;
                        } else {
                            echo "No animation found for the selected ID.";
                        }

                        // Close the statement
                        mysqli_stmt_close($stmt);
                    }
                } else {
                    $sql = "SELECT * FROM animacoes WHERE id_animacao = ?";

                    if ($stmt = mysqli_prepare($conn, $sql)) {
                        // Bind the parameter to the statement
                        mysqli_stmt_bind_param($stmt, "i", $id);

                        // Execute the statement
                        mysqli_stmt_execute($stmt);

                        // Get the result
                        $result = mysqli_stmt_get_result($stmt);

                        if ($row = mysqli_fetch_assoc($result)) {
                            // Output the result (e.g., you can return the data as JSON or HTML)
                            $_SESSION["animacao_textura"] = $row['textura'];
                            $_SESSION["animacao_objeto"] = $row['objeto']; // Example field, adjust as per your table
                            $_SESSION["animacao_id"] = $row["id_animacao"];
                            $_SESSION["create_nome"] = $nome;
                            $_SESSION["create_desc"] = $desc;
                            $_SESSION["create_ambito"] = $ambito;
                        } else {
                            echo "No animation found for the selected ID.";
                        }

                        // Close the statement
                        mysqli_stmt_close($stmt);
                    }
                }
            } else {
                if (isset($_GET['data'])) {
                    // Your SQL query
                    $data = $_GET['data'];
                    $sql = "SELECT * FROM animacoes WHERE id_animacao = ?";

                    if ($stmt = mysqli_prepare($conn, $sql)) {
                        // Bind the parameter to the statement
                        mysqli_stmt_bind_param($stmt, "i", $id);

                        // Execute the statement
                        mysqli_stmt_execute($stmt);

                        // Get the result
                        $result = mysqli_stmt_get_result($stmt);

                        if ($row = mysqli_fetch_assoc($result)) {
                            // Output the result (e.g., you can return the data as JSON or HTML)
                            $_SESSION["animacao_textura"] = $row['textura'];
                            $_SESSION["animacao_objeto"] = $row['objeto']; // Example field, adjust as per your table
                            $_SESSION["animacao_id"] = $row["id_animacao"];
                            $_SESSION["create_nome"] = $nome;
                            $_SESSION["create_desc"] = $desc;
                            $_SESSION["create_data"] = $data;
                        } else {
                            echo "No animation found for the selected ID.";
                        }

                        // Close the statement
                        mysqli_stmt_close($stmt);
                    }
                } else {
                    // Your SQL query
                    if (isset($_GET['professores'])) {
                        $professores = $_GET['professores'];
                        if (isset($_GET['regime'])) {
                            $regime = $_GET['regime'];
                            if (isset($_GET['unidade'])) {
                                $unidade = $_GET['unidade'];
                                $sql = "SELECT * FROM animacoes WHERE id_animacao = ?";

                                if ($stmt = mysqli_prepare($conn, $sql)) {
                                    // Bind the parameter to the statement
                                    mysqli_stmt_bind_param($stmt, "i", $id);

                                    // Execute the statement
                                    mysqli_stmt_execute($stmt);

                                    // Get the result
                                    $result = mysqli_stmt_get_result($stmt);

                                    if ($row = mysqli_fetch_assoc($result)) {
                                        // Output the result (e.g., you can return the data as JSON or HTML)
                                        $_SESSION["animacao_textura"] = $row['textura'];
                                        $_SESSION["animacao_objeto"] = $row['objeto']; // Example field, adjust as per your table
                                        $_SESSION["animacao_id"] = $row["id_animacao"];
                                        $_SESSION["create_nome"] = $nome;
                                        $_SESSION["create_desc"] = $desc;
                                        $_SESSION["professor_curso"] = $professores;
                                        $_SESSION["create_regime"] = $regime;
                                        $_SESSION["unidade_curso"] = $unidade;
                                    } else {
                                        echo "No animation found for the selected ID.";
                                    }

                                    // Close the statement
                                    mysqli_stmt_close($stmt);
                                }
                            } else {
                                $sql = "SELECT * FROM animacoes WHERE id_animacao = ?";

                                if ($stmt = mysqli_prepare($conn, $sql)) {
                                    // Bind the parameter to the statement
                                    mysqli_stmt_bind_param($stmt, "i", $id);

                                    // Execute the statement
                                    mysqli_stmt_execute($stmt);

                                    // Get the result
                                    $result = mysqli_stmt_get_result($stmt);

                                    if ($row = mysqli_fetch_assoc($result)) {
                                        // Output the result (e.g., you can return the data as JSON or HTML)
                                        $_SESSION["animacao_textura"] = $row['textura'];
                                        $_SESSION["animacao_objeto"] = $row['objeto']; // Example field, adjust as per your table
                                        $_SESSION["animacao_id"] = $row["id_animacao"];
                                        $_SESSION["create_nome"] = $nome;
                                        $_SESSION["create_desc"] = $desc;
                                        $_SESSION["professor_curso"] = $professores;
                                        $_SESSION["create_regime"] = $regime;
                                    } else {
                                        echo "No animation found for the selected ID.";
                                    }

                                    // Close the statement
                                    mysqli_stmt_close($stmt);
                                }
                            }
                        } else {
                            if (isset($_GET['unidade'])) {
                                $unidade = $_GET['unidade'];
                            } else {
                            }
                            $sql = "SELECT * FROM animacoes WHERE id_animacao = ?";

                            if ($stmt = mysqli_prepare($conn, $sql)) {
                                // Bind the parameter to the statement
                                mysqli_stmt_bind_param($stmt, "i", $id);

                                // Execute the statement
                                mysqli_stmt_execute($stmt);

                                // Get the result
                                $result = mysqli_stmt_get_result($stmt);

                                if ($row = mysqli_fetch_assoc($result)) {
                                    // Output the result (e.g., you can return the data as JSON or HTML)
                                    $_SESSION["animacao_textura"] = $row['textura'];
                                    $_SESSION["animacao_objeto"] = $row['objeto']; // Example field, adjust as per your table
                                    $_SESSION["animacao_id"] = $row["id_animacao"];
                                    $_SESSION["create_nome"] = $nome;
                                    $_SESSION["create_desc"] = $desc;
                                    $_SESSION["professor_curso"] = $professores;
                                } else {
                                    echo "No animation found for the selected ID.";
                                }

                                // Close the statement
                                mysqli_stmt_close($stmt);
                            }
                        }
                    } else {
                        if (isset($_GET['regime'])) {
                            $regime = $_GET['regime'];
                            if (isset($_GET['unidade'])) {
                                $unidade = $_GET['unidade'];
                            } else {
                            }

                            $sql = "SELECT * FROM animacoes WHERE id_animacao = ?";

                            if ($stmt = mysqli_prepare($conn, $sql)) {
                                // Bind the parameter to the statement
                                mysqli_stmt_bind_param($stmt, "i", $id);

                                // Execute the statement
                                mysqli_stmt_execute($stmt);

                                // Get the result
                                $result = mysqli_stmt_get_result($stmt);

                                if ($row = mysqli_fetch_assoc($result)) {
                                    // Output the result (e.g., you can return the data as JSON or HTML)
                                    $_SESSION["animacao_textura"] = $row['textura'];
                                    $_SESSION["animacao_objeto"] = $row['objeto']; // Example field, adjust as per your table
                                    $_SESSION["animacao_id"] = $row["id_animacao"];
                                    $_SESSION["create_nome"] = $nome;
                                    $_SESSION["create_desc"] = $desc;
                                    $_SESSION["create_regime"] = $regime;
                                } else {
                                    echo "No animation found for the selected ID.";
                                }

                                // Close the statement
                                mysqli_stmt_close($stmt);
                            }
                        } else {
                            if (isset($_GET['unidade'])) {
                                $unidade = $_GET['unidade'];
                            } else {
                            }
                            $sql = "SELECT * FROM animacoes WHERE id_animacao = ?";

                            if ($stmt = mysqli_prepare($conn, $sql)) {
                                // Bind the parameter to the statement
                                mysqli_stmt_bind_param($stmt, "i", $id);

                                // Execute the statement
                                mysqli_stmt_execute($stmt);

                                // Get the result
                                $result = mysqli_stmt_get_result($stmt);

                                if ($row = mysqli_fetch_assoc($result)) {
                                    // Output the result (e.g., you can return the data as JSON or HTML)
                                    $_SESSION["animacao_textura"] = $row['textura'];
                                    $_SESSION["animacao_objeto"] = $row['objeto']; // Example field, adjust as per your table
                                    $_SESSION["animacao_id"] = $row["id_animacao"];
                                    $_SESSION["create_nome"] = $nome;
                                    $_SESSION["create_desc"] = $desc;
                                } else {
                                    echo "No animation found for the selected ID.";
                                }

                                // Close the statement
                                mysqli_stmt_close($stmt);
                            }
                        }
                    }
                }
            }
        } else {
            if (isset($_GET['ambito'])) {
                $ambito = $_GET['ambito'];
                if (isset($_GET['data'])) {
                    $data = $_GET['data'];
                    $sql = "SELECT * FROM animacoes WHERE id_animacao = ?";

                    if ($stmt = mysqli_prepare($conn, $sql)) {
                        // Bind the parameter to the statement
                        mysqli_stmt_bind_param($stmt, "i", $id);

                        // Execute the statement
                        mysqli_stmt_execute($stmt);

                        // Get the result
                        $result = mysqli_stmt_get_result($stmt);

                        if ($row = mysqli_fetch_assoc($result)) {
                            // Output the result (e.g., you can return the data as JSON or HTML)
                            $_SESSION["animacao_textura"] = $row['textura'];
                            $_SESSION["animacao_objeto"] = $row['objeto']; // Example field, adjust as per your table
                            $_SESSION["animacao_id"] = $row["id_animacao"];
                            $_SESSION["create_nome"] = $nome;
                            $_SESSION["create_ambito"] = $ambito;
                            $_SESSION["create_data"] = $data;
                        } else {
                            echo "No animation found for the selected ID.";
                        }

                        // Close the statement
                        mysqli_stmt_close($stmt);
                    }
                } else {
                    // Your SQL query
                    $sql = "SELECT * FROM animacoes WHERE id_animacao = ?";

                    if ($stmt = mysqli_prepare($conn, $sql)) {
                        // Bind the parameter to the statement
                        mysqli_stmt_bind_param($stmt, "i", $id);

                        // Execute the statement
                        mysqli_stmt_execute($stmt);

                        // Get the result
                        $result = mysqli_stmt_get_result($stmt);

                        if ($row = mysqli_fetch_assoc($result)) {
                            // Output the result (e.g., you can return the data as JSON or HTML)
                            $_SESSION["animacao_textura"] = $row['textura'];
                            $_SESSION["animacao_objeto"] = $row['objeto']; // Example field, adjust as per your table
                            $_SESSION["animacao_id"] = $row["id_animacao"];
                            $_SESSION["create_nome"] = $nome;
                            $_SESSION["create_ambito"] = $ambito;
                        } else {
                            echo "No animation found for the selected ID.";
                        }

                        // Close the statement
                        mysqli_stmt_close($stmt);
                    }
                }
            } else {
                if (isset($_GET['data'])) {
                    $data = $_GET['data'];
                    $sql = "SELECT * FROM animacoes WHERE id_animacao = ?";

                    if ($stmt = mysqli_prepare($conn, $sql)) {
                        // Bind the parameter to the statement
                        mysqli_stmt_bind_param($stmt, "i", $id);

                        // Execute the statement
                        mysqli_stmt_execute($stmt);

                        // Get the result
                        $result = mysqli_stmt_get_result($stmt);

                        if ($row = mysqli_fetch_assoc($result)) {
                            // Output the result (e.g., you can return the data as JSON or HTML)
                            $_SESSION["animacao_textura"] = $row['textura'];
                            $_SESSION["animacao_objeto"] = $row['objeto']; // Example field, adjust as per your table
                            $_SESSION["animacao_id"] = $row["id_animacao"];
                            $_SESSION["create_nome"] = $nome;;
                            $_SESSION["create_data"] = $data;
                        } else {
                            echo "No animation found for the selected ID.";
                        }

                        // Close the statement
                        mysqli_stmt_close($stmt);
                    }
                } else {
                    if (isset($_GET['professores'])) {
                        $professores = $_GET['professores'];

                        if (isset($_GET['regime'])) {
                            $regime = $_GET['regime'];
                            if (isset($_GET['unidade'])) {
                                $unidade = $_GET['unidade'];
                            } else {
                            }

                            $sql = "SELECT * FROM animacoes WHERE id_animacao = ?";

                            if ($stmt = mysqli_prepare($conn, $sql)) {
                                // Bind the parameter to the statement
                                mysqli_stmt_bind_param($stmt, "i", $id);

                                // Execute the statement
                                mysqli_stmt_execute($stmt);

                                // Get the result
                                $result = mysqli_stmt_get_result($stmt);

                                if ($row = mysqli_fetch_assoc($result)) {
                                    // Output the result (e.g., you can return the data as JSON or HTML)
                                    $_SESSION["animacao_textura"] = $row['textura'];
                                    $_SESSION["animacao_objeto"] = $row['objeto']; // Example field, adjust as per your table
                                    $_SESSION["animacao_id"] = $row["id_animacao"];
                                    $_SESSION["create_nome"] = $nome;
                                    $_SESSION["professor_curso"] = $professores;
                                    $_SESSION["create_regime"] = $regime;
                                } else {
                                    echo "No animation found for the selected ID.";
                                }

                                // Close the statement
                                mysqli_stmt_close($stmt);
                            }
                        } else {
                            if (isset($_GET['unidade'])) {
                                $unidade = $_GET['unidade'];
                            } else {
                            }
                            $sql = "SELECT * FROM animacoes WHERE id_animacao = ?";

                            if ($stmt = mysqli_prepare($conn, $sql)) {
                                // Bind the parameter to the statement
                                mysqli_stmt_bind_param($stmt, "i", $id);

                                // Execute the statement
                                mysqli_stmt_execute($stmt);

                                // Get the result
                                $result = mysqli_stmt_get_result($stmt);

                                if ($row = mysqli_fetch_assoc($result)) {
                                    // Output the result (e.g., you can return the data as JSON or HTML)
                                    $_SESSION["animacao_textura"] = $row['textura'];
                                    $_SESSION["animacao_objeto"] = $row['objeto']; // Example field, adjust as per your table
                                    $_SESSION["animacao_id"] = $row["id_animacao"];
                                    $_SESSION["create_nome"] = $nome;
                                    $_SESSION["professor_curso"] = $professores;
                                } else {
                                    echo "No animation found for the selected ID.";
                                }

                                // Close the statement
                                mysqli_stmt_close($stmt);
                            }
                        }
                    } else {
                        if (isset($_GET['regime'])) {
                            $regime = $_GET['regime'];
                            if (isset($_GET['unidade'])) {
                                $unidade = $_GET['unidade'];
                            } else {
                            }

                            $sql = "SELECT * FROM animacoes WHERE id_animacao = ?";

                            if ($stmt = mysqli_prepare($conn, $sql)) {
                                // Bind the parameter to the statement
                                mysqli_stmt_bind_param($stmt, "i", $id);

                                // Execute the statement
                                mysqli_stmt_execute($stmt);

                                // Get the result
                                $result = mysqli_stmt_get_result($stmt);

                                if ($row = mysqli_fetch_assoc($result)) {
                                    // Output the result (e.g., you can return the data as JSON or HTML)
                                    $_SESSION["animacao_textura"] = $row['textura'];
                                    $_SESSION["animacao_objeto"] = $row['objeto']; // Example field, adjust as per your table
                                    $_SESSION["animacao_id"] = $row["id_animacao"];
                                    $_SESSION["create_nome"] = $nome;
                                    $_SESSION["create_regime"] = $regime;
                                } else {
                                    echo "No animation found for the selected ID.";
                                }

                                // Close the statement
                                mysqli_stmt_close($stmt);
                            }
                        } else {
                            if (isset($_GET['unidade'])) {
                                $unidade = $_GET['unidade'];
                            } else {
                            }
                            $sql = "SELECT * FROM animacoes WHERE id_animacao = ?";

                            if ($stmt = mysqli_prepare($conn, $sql)) {
                                // Bind the parameter to the statement
                                mysqli_stmt_bind_param($stmt, "i", $id);

                                // Execute the statement
                                mysqli_stmt_execute($stmt);

                                // Get the result
                                $result = mysqli_stmt_get_result($stmt);

                                if ($row = mysqli_fetch_assoc($result)) {
                                    // Output the result (e.g., you can return the data as JSON or HTML)
                                    $_SESSION["animacao_textura"] = $row['textura'];
                                    $_SESSION["animacao_objeto"] = $row['objeto']; // Example field, adjust as per your table
                                    $_SESSION["animacao_id"] = $row["id_animacao"];
                                    $_SESSION["create_nome"] = $nome;
                                } else {
                                    echo "No animation found for the selected ID.";
                                }

                                // Close the statement
                                mysqli_stmt_close($stmt);
                            }
                        }
                    }
                }
            }
        }
    } else if (isset($_GET["desc"])) {
        $desc = $_GET['desc'];
        if (isset($_GET['ambito'])) {
            $ambito = $_GET['ambito'];
            if (isset($_GET['data'])) {
                $data = $_GET['data'];
                $sql = "SELECT * FROM animacoes WHERE id_animacao = ?";

                if ($stmt = mysqli_prepare($conn, $sql)) {
                    // Bind the parameter to the statement
                    mysqli_stmt_bind_param($stmt, "i", $id);

                    // Execute the statement
                    mysqli_stmt_execute($stmt);

                    // Get the result
                    $result = mysqli_stmt_get_result($stmt);

                    if ($row = mysqli_fetch_assoc($result)) {
                        // Output the result (e.g., you can return the data as JSON or HTML)
                        $_SESSION["animacao_textura"] = $row['textura'];
                        $_SESSION["animacao_objeto"] = $row['objeto']; // Example field, adjust as per your table
                        $_SESSION["animacao_id"] = $row["id_animacao"];
                        $_SESSION["create_desc"] = $desc;
                        $_SESSION["create_ambito"] = $ambito;
                        $_SESSION["create_data"] = $data;
                    } else {
                        echo "No animation found for the selected ID.";
                    }

                    // Close the statement
                    mysqli_stmt_close($stmt);
                }
            } else {
                // Your SQL query
                $sql = "SELECT * FROM animacoes WHERE id_animacao = ?";

                if ($stmt = mysqli_prepare($conn, $sql)) {
                    // Bind the parameter to the statement
                    mysqli_stmt_bind_param($stmt, "i", $id);

                    // Execute the statement
                    mysqli_stmt_execute($stmt);

                    // Get the result
                    $result = mysqli_stmt_get_result($stmt);

                    if ($row = mysqli_fetch_assoc($result)) {
                        // Output the result (e.g., you can return the data as JSON or HTML)
                        $_SESSION["animacao_textura"] = $row['textura'];
                        $_SESSION["animacao_objeto"] = $row['objeto']; // Example field, adjust as per your table
                        $_SESSION["animacao_id"] = $row["id_animacao"];
                        $_SESSION["create_desc"] = $desc;
                        $_SESSION["create_ambito"] = $ambito;
                    } else {
                        echo "No animation found for the selected ID.";
                    }

                    // Close the statement
                    mysqli_stmt_close($stmt);
                }
            }
        } else {
            // Your SQL query
            if (isset($_GET['data'])) {
                $data = $_GET['data'];
                $sql = "SELECT * FROM animacoes WHERE id_animacao = ?";

                if ($stmt = mysqli_prepare($conn, $sql)) {
                    // Bind the parameter to the statement
                    mysqli_stmt_bind_param($stmt, "i", $id);

                    // Execute the statement
                    mysqli_stmt_execute($stmt);

                    // Get the result
                    $result = mysqli_stmt_get_result($stmt);

                    if ($row = mysqli_fetch_assoc($result)) {
                        // Output the result (e.g., you can return the data as JSON or HTML)
                        $_SESSION["animacao_textura"] = $row['textura'];
                        $_SESSION["animacao_objeto"] = $row['objeto']; // Example field, adjust as per your table
                        $_SESSION["animacao_id"] = $row["id_animacao"];
                        $_SESSION["create_desc"] = $desc;
                        $_SESSION["create_data"] = $data;
                    } else {
                        echo "No animation found for the selected ID.";
                    }

                    // Close the statement
                    mysqli_stmt_close($stmt);
                }
            } else {
                if (isset($_GET['professores'])) {
                    $professores = $_GET['professores'];
                    if (isset($_GET['regime'])) {
                        $regime = $_GET['regime'];
                        if (isset($_GET['unidade'])) {
                            $unidade = $_GET['unidade'];
                        } else {
                        }

                        $sql = "SELECT * FROM animacoes WHERE id_animacao = ?";

                        if ($stmt = mysqli_prepare($conn, $sql)) {
                            // Bind the parameter to the statement
                            mysqli_stmt_bind_param($stmt, "i", $id);

                            // Execute the statement
                            mysqli_stmt_execute($stmt);

                            // Get the result
                            $result = mysqli_stmt_get_result($stmt);

                            if ($row = mysqli_fetch_assoc($result)) {
                                // Output the result (e.g., you can return the data as JSON or HTML)
                                $_SESSION["animacao_textura"] = $row['textura'];
                                $_SESSION["animacao_objeto"] = $row['objeto']; // Example field, adjust as per your table
                                $_SESSION["animacao_id"] = $row["id_animacao"];
                                $_SESSION["create_nome"] = $nome;
                                $_SESSION["professor_curso"] = $professores;
                                $_SESSION["create_regime"] = $regime;
                            } else {
                                echo "No animation found for the selected ID.";
                            }

                            // Close the statement
                            mysqli_stmt_close($stmt);
                        }
                    } else {
                        if (isset($_GET['unidade'])) {
                            $unidade = $_GET['unidade'];
                        } else {
                        }
                        $sql = "SELECT * FROM animacoes WHERE id_animacao = ?";

                        if ($stmt = mysqli_prepare($conn, $sql)) {
                            // Bind the parameter to the statement
                            mysqli_stmt_bind_param($stmt, "i", $id);

                            // Execute the statement
                            mysqli_stmt_execute($stmt);

                            // Get the result
                            $result = mysqli_stmt_get_result($stmt);

                            if ($row = mysqli_fetch_assoc($result)) {
                                // Output the result (e.g., you can return the data as JSON or HTML)
                                $_SESSION["animacao_textura"] = $row['textura'];
                                $_SESSION["animacao_objeto"] = $row['objeto']; // Example field, adjust as per your table
                                $_SESSION["animacao_id"] = $row["id_animacao"];
                                $_SESSION["create_desc"] = $desc;
                            } else {
                                echo "No animation found for the selected ID.";
                            }

                            // Close the statement
                            mysqli_stmt_close($stmt);
                        }
                    }
                } else {
                    if (isset($_GET['unidade'])) {
                        $unidade = $_GET['unidade'];
                    } else {
                    }
                    $sql = "SELECT * FROM animacoes WHERE id_animacao = ?";

                    if ($stmt = mysqli_prepare($conn, $sql)) {
                        // Bind the parameter to the statement
                        mysqli_stmt_bind_param($stmt, "i", $id);

                        // Execute the statement
                        mysqli_stmt_execute($stmt);

                        // Get the result
                        $result = mysqli_stmt_get_result($stmt);

                        if ($row = mysqli_fetch_assoc($result)) {
                            // Output the result (e.g., you can return the data as JSON or HTML)
                            $_SESSION["animacao_textura"] = $row['textura'];
                            $_SESSION["animacao_objeto"] = $row['objeto']; // Example field, adjust as per your table
                            $_SESSION["animacao_id"] = $row["id_animacao"];
                            $_SESSION["create_desc"] = $desc;
                        } else {
                            echo "No animation found for the selected ID.";
                        }

                        // Close the statement
                        mysqli_stmt_close($stmt);
                    }
                }
            }
        }
    } else if (isset($_GET['ambito'])) {
        $ambito = $_GET['ambito'];
        if (isset($_GET['data'])) {
            $data = $_GET['data'];
            $sql = "SELECT * FROM animacoes WHERE id_animacao = ?";

            if ($stmt = mysqli_prepare($conn, $sql)) {
                // Bind the parameter to the statement
                mysqli_stmt_bind_param($stmt, "i", $id);

                // Execute the statement
                mysqli_stmt_execute($stmt);

                // Get the result
                $result = mysqli_stmt_get_result($stmt);

                if ($row = mysqli_fetch_assoc($result)) {
                    // Output the result (e.g., you can return the data as JSON or HTML)
                    $_SESSION["animacao_textura"] = $row['textura'];
                    $_SESSION["animacao_objeto"] = $row['objeto']; // Example field, adjust as per your table
                    $_SESSION["animacao_id"] = $row["id_animacao"];
                    $_SESSION["create_ambito"] = $ambito;
                    $_SESSION["create_data"] = $data;
                } else {
                    echo "No animation found for the selected ID.";
                }

                // Close the statement
                mysqli_stmt_close($stmt);
            }
        } else {
            $sql = "SELECT * FROM animacoes WHERE id_animacao = ?";

            if ($stmt = mysqli_prepare($conn, $sql)) {
                // Bind the parameter to the statement
                mysqli_stmt_bind_param($stmt, "i", $id);

                // Execute the statement
                mysqli_stmt_execute($stmt);

                // Get the result
                $result = mysqli_stmt_get_result($stmt);

                if ($row = mysqli_fetch_assoc($result)) {
                    // Output the result (e.g., you can return the data as JSON or HTML)
                    $_SESSION["animacao_textura"] = $row['textura'];
                    $_SESSION["animacao_objeto"] = $row['objeto']; // Example field, adjust as per your table
                    $_SESSION["animacao_id"] = $row["id_animacao"];
                    $_SESSION["create_ambito"] = $ambito;
                } else {
                    echo "No animation found for the selected ID.";
                }

                // Close the statement
                mysqli_stmt_close($stmt);
            }
        }
    } else if (isset($_GET['data'])) {
        $data = $_GET['data'];
        $sql = "SELECT * FROM animacoes WHERE id_animacao = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind the parameter to the statement
            mysqli_stmt_bind_param($stmt, "i", $id);

            // Execute the statement
            mysqli_stmt_execute($stmt);

            // Get the result
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                // Output the result (e.g., you can return the data as JSON or HTML)
                $_SESSION["animacao_textura"] = $row['textura'];
                $_SESSION["animacao_objeto"] = $row['objeto']; // Example field, adjust as per your table
                $_SESSION["animacao_id"] = $row["id_animacao"];
                $_SESSION["create_data"] = $data;
            } else {
                echo "No animation found for the selected ID.";
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        }
    } else if (isset($_GET['professores'])) {
        $professores = $_GET['professores'];
        if (isset($_GET['regime'])) {
            $regime = $_GET['regime'];
            if (isset($_GET['unidade'])) {
                $unidade = $_GET['unidade'];
            } else {
            }

            $sql = "SELECT * FROM animacoes WHERE id_animacao = ?";

            if ($stmt = mysqli_prepare($conn, $sql)) {
                // Bind the parameter to the statement
                mysqli_stmt_bind_param($stmt, "i", $id);

                // Execute the statement
                mysqli_stmt_execute($stmt);

                // Get the result
                $result = mysqli_stmt_get_result($stmt);

                if ($row = mysqli_fetch_assoc($result)) {
                    // Output the result (e.g., you can return the data as JSON or HTML)
                    $_SESSION["animacao_textura"] = $row['textura'];
                    $_SESSION["animacao_objeto"] = $row['objeto']; // Example field, adjust as per your table
                    $_SESSION["animacao_id"] = $row["id_animacao"];
                    $_SESSION["professor_curso"] = $professores;
                    $_SESSION["create_regime"] = $regime;
                } else {
                    echo "No animation found for the selected ID.";
                }

                // Close the statement
                mysqli_stmt_close($stmt);
            }
        } else {
            if (isset($_GET['unidade'])) {
                $unidade = $_GET['unidade'];
            } else {
            }
            $sql = "SELECT * FROM animacoes WHERE id_animacao = ?";

            if ($stmt = mysqli_prepare($conn, $sql)) {
                // Bind the parameter to the statement
                mysqli_stmt_bind_param($stmt, "i", $id);

                // Execute the statement
                mysqli_stmt_execute($stmt);

                // Get the result
                $result = mysqli_stmt_get_result($stmt);

                if ($row = mysqli_fetch_assoc($result)) {
                    // Output the result (e.g., you can return the data as JSON or HTML)
                    $_SESSION["animacao_textura"] = $row['textura'];
                    $_SESSION["animacao_objeto"] = $row['objeto']; // Example field, adjust as per your table
                    $_SESSION["animacao_id"] = $row["id_animacao"];
                } else {
                    echo "No animation found for the selected ID.";
                }

                // Close the statement
                mysqli_stmt_close($stmt);
            }
        }
    } else if (isset($_GET['regime'])) {
        $regime = $_GET['regime'];
        if (isset($_GET['unidade'])) {
            $unidade = $_GET['unidade'];
            $sql = "SELECT * FROM animacoes WHERE id_animacao = ?";

            if ($stmt = mysqli_prepare($conn, $sql)) {
                // Bind the parameter to the statement
                mysqli_stmt_bind_param($stmt, "i", $id);

                // Execute the statement
                mysqli_stmt_execute($stmt);

                // Get the result
                $result = mysqli_stmt_get_result($stmt);

                if ($row = mysqli_fetch_assoc($result)) {
                    // Output the result (e.g., you can return the data as JSON or HTML)
                    $_SESSION["animacao_textura"] = $row['textura'];
                    $_SESSION["animacao_objeto"] = $row['objeto']; // Example field, adjust as per your table
                    $_SESSION["animacao_id"] = $row["id_animacao"];
                    $_SESSION["create_regime"] = $regime;
                    $_SESSION["unidade_curso"] = $unidade;
                } else {
                    echo "No animation found for the selected ID.";
                }

                // Close the statement
                mysqli_stmt_close($stmt);
            }
        } else {
            $sql = "SELECT * FROM animacoes WHERE id_animacao = ?";

            if ($stmt = mysqli_prepare($conn, $sql)) {
                // Bind the parameter to the statement
                mysqli_stmt_bind_param($stmt, "i", $id);

                // Execute the statement
                mysqli_stmt_execute($stmt);

                // Get the result
                $result = mysqli_stmt_get_result($stmt);

                if ($row = mysqli_fetch_assoc($result)) {
                    // Output the result (e.g., you can return the data as JSON or HTML)
                    $_SESSION["animacao_textura"] = $row['textura'];
                    $_SESSION["animacao_objeto"] = $row['objeto']; // Example field, adjust as per your table
                    $_SESSION["animacao_id"] = $row["id_animacao"];
                    $_SESSION["create_regime"] = $regime;
                } else {
                    echo "No animation found for the selected ID.";
                }

                // Close the statement
                mysqli_stmt_close($stmt);
            }
        }
    } else if (isset($_GET['unidade'])) {
        $unidade = $_GET['unidade'];

        $sql = "SELECT * FROM animacoes WHERE id_animacao = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind the parameter to the statement
            mysqli_stmt_bind_param($stmt, "i", $id);

            // Execute the statement
            mysqli_stmt_execute($stmt);

            // Get the result
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                // Output the result (e.g., you can return the data as JSON or HTML)
                $_SESSION["animacao_textura"] = $row['textura'];
                $_SESSION["animacao_objeto"] = $row['objeto']; // Example field, adjust as per your table
                $_SESSION["animacao_id"] = $row["id_animacao"];
                $_SESSION["unidade_curso"] = $unidade;
            } else {
                echo "No animation found for the selected ID.";
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        }
    } else {
        $sql = "SELECT * FROM animacoes WHERE id_animacao = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind the parameter to the statement
            mysqli_stmt_bind_param($stmt, "i", $id);

            // Execute the statement
            mysqli_stmt_execute($stmt);

            // Get the result
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                // Output the result (e.g., you can return the data as JSON or HTML)
                $_SESSION["animacao_textura"] = $row['textura'];
                $_SESSION["animacao_objeto"] = $row['objeto']; // Example field, adjust as per your table
                $_SESSION["animacao_id"] = $row["id_animacao"];
            } else {
                echo "No animation found for the selected ID.";
            }

            // Close the statement
            mysqli_stmt_close($stmt);
        }
    }
}
if (isset($_GET["evento"])) {
    $evento = $_GET["evento"];
    $_SESSION["evento_curso "] = $evento;
}
mysqli_close($conn); // Close the database connection

header("Location: ../../admin/" . $page . "/create.php");
