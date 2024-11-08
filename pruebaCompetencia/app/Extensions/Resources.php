<?php

namespace App\Extensions;

use App\Autor;

class Resources
{
    public static function validateCreateAutor($data, $type)
    {
        $error = array();

        switch ($type) {
            case '1':
                if (!empty($data)) {
                    if (empty($data['name'])) {
                        $mensaje = "Debe ingresar el Nombre del autor. Es un campo requerido";
                        array_push($error, $mensaje);
                    } elseif (empty($data['lastname'])) {
                        $mensaje = "Debe ingresar el Apellido del autor. Es un campo requerido";
                        array_push($error, $mensaje);
                    } elseif (empty($data['nationality'])) {
                        $mensaje = "Debe ingresar la Nacionalidad del autor. Es un campo requerido";
                        array_push($error, $mensaje);
                    } elseif (empty($data['biografy'])) {
                        $mensaje = "Debe ingresar una breve Biografia del autor. Es un campo requerido";
                        array_push($error, $mensaje);
                    } elseif (empty($data['email'])) {
                        $mensaje = "Debe ingresar el Correo del autor. Es un campo requerido";
                        array_push($error, $mensaje);
                    }
                } else {
                    $mensaje = "Debe llenar todos los campos requeridos";
                    array_push($error, $mensaje);
                }
                break;
            case '2':
                if (!empty($data)) {
                    if (empty($data['idAutor'])) {
                        $mensaje = "El ID del autora a editar es requerido";
                        array_push($error, $mensaje);
                    } elseif (empty($data['name'])) {
                        $mensaje = "Debe ingresar el Nombre del autor. Es un campo requerido";
                        array_push($error, $mensaje);
                    } elseif (empty($data['lastname'])) {
                        $mensaje = "Debe ingresar el Apellido del autor. Es un campo requerido";
                        array_push($error, $mensaje);
                    } elseif (empty($data['nationality'])) {
                        $mensaje = "Debe ingresar la Nacionalidad del autor. Es un campo requerido";
                        array_push($error, $mensaje);
                    } elseif (empty($data['biografy'])) {
                        $mensaje = "Debe ingresar una breve Biografia del autor. Es un campo requerido";
                        array_push($error, $mensaje);
                    }
                } else {
                    $mensaje = "Debe llenar todos los campos requeridos";
                    array_push($error, $mensaje);
                }

                break;

            default:
                # code...
                break;
        }

        return $error;
    }

    public static function validateCreateLibro($data, $type)
    {
        $error = array();

        switch ($type) {
            case '1':
                if (!empty($data)) {
                    if (empty($data['title'])) {
                        $mensaje = "Debe ingresar el Titulo  del Libro. Es un campo requerido";
                        array_push($error, $mensaje);
                    } elseif (empty($data['year_publication'])) {
                        $mensaje = "Debe ingresar el Año de publicación  del Libro. Es un campo requerido";
                        array_push($error, $mensaje);
                    } elseif (empty($data['gender'])) {
                        $mensaje = "Debe ingresar el Genero Literario  del Libro. Es un campo requerido";
                        array_push($error, $mensaje);
                    } elseif (empty($data['editorial'])) {
                        $mensaje = "Debe ingresar un Editorial  del Libro. Es un campo requerido";
                        array_push($error, $mensaje);
                    } elseif (empty($data['pages'])) {
                        $mensaje = "Debe ingresar la cantidad de páginas del Libro. Es un campo requerido";
                        array_push($error, $mensaje);
                    }
                } else {
                    $mensaje = "Debe llenar todos los campos requeridos";
                    array_push($error, $mensaje);
                }


                $validaExisteAutor = self::validaExisteAutor($data['idAutor']);

                if (isset($validaExisteAutor['autorNoExiste'][0])) {
                    if (in_array(0, $validaExisteAutor['autorNoExiste'][0])) {
                        $mensaje = "El / Los autores con el / los siguientes Id's " . $validaExisteAutor['id'] . " no existen en la Base de datos verifique la información";
                        array_push($error, $mensaje);
                    }
                }
                
                break;
            case '2':
                if (!empty($data)) {
                    if (empty($data['idLibro'])) {
                        $mensaje = "El ID del libro a editar es requerido";
                        array_push($error, $mensaje);
                    } elseif (empty($data['title'])) {
                        $mensaje = "Debe ingresar el Titulo del Libro. Es un campo requerido";
                        array_push($error, $mensaje);
                    } elseif (empty($data['year_publication'])) {
                        $mensaje = "Debe ingresar el Año de publicación del Libro. Es un campo requerido";
                        array_push($error, $mensaje);
                    } elseif (empty($data['gender'])) {
                        $mensaje = "Debe ingresar el Genero Literario del Libro. Es un campo requerido";
                        array_push($error, $mensaje);
                    } elseif (empty($data['editorial'])) {
                        $mensaje = "Debe ingresar la Editorial del Libro. Es un campo requerido";
                        array_push($error, $mensaje);
                    } elseif (empty($data['pages'])) {
                        $mensaje = "Debe ingresar cantidad de páginas del Libro. Es un campo requerido";
                        array_push($error, $mensaje);
                    }
                } else {
                    $mensaje = "Debe llenar todos los campos requeridos";
                    array_push($error, $mensaje);
                }

                break;

            default:
                # code...
                break;
        }


        return $error;
    }

    private static function validaExisteAutor($data)
    {
        $autor = array();
        $error = array();
        $id = "";

        if (!empty($data)) {
            for ($i = 0; $i < count($data); $i++) {
                $existe = Autor::where('id', $data[$i])->get();
                if (isset($existe[0]->id)) {
                    array_push($autor, [1, 'id' => $data[$i]]);
                } else {
                    $id .= $data[$i] . ",";
                    array_push($error, [0, 'id' => $data[$i]]);
                }
            }
        }
        $response['autorExiste'] = $autor;
        $response['autorNoExiste'] = $error;
        $response['id'] = $id;

        return $response;
    }
}
