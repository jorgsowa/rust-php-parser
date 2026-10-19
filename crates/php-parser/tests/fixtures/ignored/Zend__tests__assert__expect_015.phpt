===source===
<?php
try {
assert(0 && ($a = function () {
    global $a, $$b;
    static $c, $d = 0;
    unset($e);
    $x = isset($a) && !empty($b) || eval($c);
    $x = $a ? $b : $c;
    $x = $a ?: $c;
    $x = $a ?? $b;
    list($a, $b, $c) = [1, 2=>'x', 'z'=>'c'];
    @foo();
    $y = clone $x;
    yield 1 => 2;
    yield from $x;
}));
} catch (AssertionError $e) {
    echo $e->getMessage(), PHP_EOL;
}

try {
assert(0 && ($a = function &(array &$a, ?X $b = null) use ($c,&$d) : ?X {
    abstract class A extends B implements C, D {
        const X = 12;
        const Y = self::X, Z = "aaa";

        public $a = 1, $b;
        protected $c;
        static private $d = null;

        abstract function foo();

        static private function f1() {
            for ($i = 0, $j = 100; $i < $j; $i++, --$j) {
                $s[$i] = $a[$j];
            }
            foreach ($a as $key => &$val) {
                print "$key => $val\n";
            }
            while ($s[$i]) {
                $i++;
            }
            do {
                $i--;
            } while ($s[$i]);
            $x = foo($a + 1, 4, ...[1,2,3]);
            $x = ${$a . "_1"}();
            $x = A::foo();
            $x = ${$a . "_1"}::foo();
            $x = A::${$a . "_1"}();
            $x = $x->foo();
            $x = ${$a . "_1"}->foo();
            $x = $x->{$a . "_1"}();
            $x->a = C::C;
            ${$a . "_1"}->a = ${$a . "_1"}::C;
            $x->{a . "_1"} = C::C;
            $x = C::$z;
            $x = ${$a . "_1"}::$z;
            $x = C::${$z . "_1"};
            $x?->y;
            $x?->y();
            foo(bar: $x);
        }
    }
}));
} catch (AssertionError $e) {
    echo $e->getMessage(), PHP_EOL;
}

try {
assert(0 && ($a = function &(array &$a, X $b = null, int|float $c) use ($c,&$d) : X {
    final class A {
        final protected function f2() {
            if (!$x) {
                return 0;
            }
            if ($x == 1) {
                return 1;
            } else if ($x == 2) {
                return 2;
            } else if ($x == 3) {
                return 3;
            } else {
                if ($x == 9) {
                    return 9;
                }
L0:
                do {
                    switch ($x) {
                        case 4: break;
                        case 5: continue;
                        case 6: break 2;
                        case 7: continue 2;
                        case 8: goto L0;
                        default: return;
                    }
                } while (0);
            }
        }
    }
}));
} catch (AssertionError $e) {
    echo $e->getMessage(), PHP_EOL;
}

try {
assert(0 && ($a = function &(?array &$a, X $b = null) use ($c,&$d) : X {
    class A {
        use T1, T2 {
            T1::foo insteadof foo;
            T2::foo as bar;
            baz as public;
            ops as protected x;
        }
        use T3;
    }
}));
} catch (AssertionError $e) {
    echo $e->getMessage(), PHP_EOL;
}

try {
assert(0 && ($a = function &(array &...$a) {
    declare(A=1,B=2);
    try {
        $i++;
    } catch (MyException $e) {
        echo 1;
    } catch (Exception $e) {
        echo 2;
    } finally {
        echo 3;
    }
}));
} catch (AssertionError $e) {
    echo $e->getMessage(), PHP_EOL;
}

try {
assert(0 && ($a = function (): ?static {
    declare(C=1) { echo 1; }
    $x = '\'"`$a';
    $x = "'\"`$a";
    $x = `'"\`$a`;
    $x = "{$a}b";
    $x = "${a}b";
    $x = " {$foo->bar} ${$foo->bar} ";
    $x = " ${'---'} ";
    foo();
    \foo();
    namespace\foo();
    $x = foo;
    $x = \foo;
    $x = namespace\foo;
    $x = new foo();
    $x = new \foo();
    $x = new namespace\foo();
    if ($a) {
    } elseif ($b) {
    }
    if ($a); else;
}));
} catch (AssertionError $e) {
    echo $e->getMessage(), PHP_EOL;
}

?>
===ast >=8.5===
{
  "stmts": [
    {
      "kind": {
        "TryCatch": {
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "assert"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 12,
                              "end": 18
                            }
                          }
                        },
                        "span": {
                          "start": 12,
                          "end": 18
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "kind": {
                            "Value": {
                              "kind": {
                                "Binary": {
                                  "left": {
                                    "kind": {
                                      "Int": 0
                                    },
                                    "span": {
                                      "start": 19,
                                      "end": 20
                                    }
                                  },
                                  "op": "BooleanAnd",
                                  "right": {
                                    "kind": {
                                      "Parenthesized": {
                                        "kind": {
                                          "Assign": {
                                            "target": {
                                              "kind": {
                                                "Variable": "a"
                                              },
                                              "span": {
                                                "start": 25,
                                                "end": 27
                                              }
                                            },
                                            "op": "Assign",
                                            "value": {
                                              "kind": {
                                                "Closure": {
                                                  "is_static": false,
                                                  "by_ref": false,
                                                  "params": [],
                                                  "use_vars": [],
                                                  "return_type": null,
                                                  "body": [
                                                    {
                                                      "kind": {
                                                        "Global": [
                                                          {
                                                            "kind": {
                                                              "Variable": "a"
                                                            },
                                                            "span": {
                                                              "start": 55,
                                                              "end": 57
                                                            }
                                                          },
                                                          {
                                                            "kind": {
                                                              "VariableVariable": {
                                                                "kind": {
                                                                  "Variable": "b"
                                                                },
                                                                "span": {
                                                                  "start": 60,
                                                                  "end": 62
                                                                }
                                                              }
                                                            },
                                                            "span": {
                                                              "start": 59,
                                                              "end": 62
                                                            }
                                                          }
                                                        ]
                                                      },
                                                      "span": {
                                                        "start": 48,
                                                        "end": 63
                                                      }
                                                    },
                                                    {
                                                      "kind": {
                                                        "StaticVar": [
                                                          {
                                                            "name": {
                                                              "name": "c",
                                                              "span": {
                                                                "start": 75,
                                                                "end": 77
                                                              }
                                                            },
                                                            "default": null,
                                                            "span": {
                                                              "start": 75,
                                                              "end": 77
                                                            }
                                                          },
                                                          {
                                                            "name": {
                                                              "name": "d",
                                                              "span": {
                                                                "start": 79,
                                                                "end": 81
                                                              }
                                                            },
                                                            "default": {
                                                              "kind": {
                                                                "Int": 0
                                                              },
                                                              "span": {
                                                                "start": 84,
                                                                "end": 85
                                                              }
                                                            },
                                                            "span": {
                                                              "start": 79,
                                                              "end": 85
                                                            }
                                                          }
                                                        ]
                                                      },
                                                      "span": {
                                                        "start": 68,
                                                        "end": 86
                                                      }
                                                    },
                                                    {
                                                      "kind": {
                                                        "Unset": [
                                                          {
                                                            "kind": {
                                                              "Variable": "e"
                                                            },
                                                            "span": {
                                                              "start": 97,
                                                              "end": 99
                                                            }
                                                          }
                                                        ]
                                                      },
                                                      "span": {
                                                        "start": 91,
                                                        "end": 101
                                                      }
                                                    },
                                                    {
                                                      "kind": {
                                                        "Expression": {
                                                          "kind": {
                                                            "Assign": {
                                                              "target": {
                                                                "kind": {
                                                                  "Variable": "x"
                                                                },
                                                                "span": {
                                                                  "start": 106,
                                                                  "end": 108
                                                                }
                                                              },
                                                              "op": "Assign",
                                                              "value": {
                                                                "kind": {
                                                                  "Binary": {
                                                                    "left": {
                                                                      "kind": {
                                                                        "Binary": {
                                                                          "left": {
                                                                            "kind": {
                                                                              "Isset": [
                                                                                {
                                                                                  "kind": {
                                                                                    "Variable": "a"
                                                                                  },
                                                                                  "span": {
                                                                                    "start": 117,
                                                                                    "end": 119
                                                                                  }
                                                                                }
                                                                              ]
                                                                            },
                                                                            "span": {
                                                                              "start": 111,
                                                                              "end": 120
                                                                            }
                                                                          },
                                                                          "op": "BooleanAnd",
                                                                          "right": {
                                                                            "kind": {
                                                                              "UnaryPrefix": {
                                                                                "op": "BooleanNot",
                                                                                "operand": {
                                                                                  "kind": {
                                                                                    "Empty": {
                                                                                      "kind": {
                                                                                        "Variable": "b"
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 131,
                                                                                        "end": 133
                                                                                      }
                                                                                    }
                                                                                  },
                                                                                  "span": {
                                                                                    "start": 125,
                                                                                    "end": 134
                                                                                  }
                                                                                }
                                                                              }
                                                                            },
                                                                            "span": {
                                                                              "start": 124,
                                                                              "end": 134
                                                                            }
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 111,
                                                                        "end": 134
                                                                      }
                                                                    },
                                                                    "op": "BooleanOr",
                                                                    "right": {
                                                                      "kind": {
                                                                        "Eval": {
                                                                          "kind": {
                                                                            "Variable": "c"
                                                                          },
                                                                          "span": {
                                                                            "start": 143,
                                                                            "end": 145
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 138,
                                                                        "end": 146
                                                                      }
                                                                    }
                                                                  }
                                                                },
                                                                "span": {
                                                                  "start": 111,
                                                                  "end": 146
                                                                }
                                                              }
                                                            }
                                                          },
                                                          "span": {
                                                            "start": 106,
                                                            "end": 146
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 106,
                                                        "end": 147
                                                      }
                                                    },
                                                    {
                                                      "kind": {
                                                        "Expression": {
                                                          "kind": {
                                                            "Assign": {
                                                              "target": {
                                                                "kind": {
                                                                  "Variable": "x"
                                                                },
                                                                "span": {
                                                                  "start": 152,
                                                                  "end": 154
                                                                }
                                                              },
                                                              "op": "Assign",
                                                              "value": {
                                                                "kind": {
                                                                  "Ternary": {
                                                                    "condition": {
                                                                      "kind": {
                                                                        "Variable": "a"
                                                                      },
                                                                      "span": {
                                                                        "start": 157,
                                                                        "end": 159
                                                                      }
                                                                    },
                                                                    "then_expr": {
                                                                      "kind": {
                                                                        "Variable": "b"
                                                                      },
                                                                      "span": {
                                                                        "start": 162,
                                                                        "end": 164
                                                                      }
                                                                    },
                                                                    "else_expr": {
                                                                      "kind": {
                                                                        "Variable": "c"
                                                                      },
                                                                      "span": {
                                                                        "start": 167,
                                                                        "end": 169
                                                                      }
                                                                    }
                                                                  }
                                                                },
                                                                "span": {
                                                                  "start": 157,
                                                                  "end": 169
                                                                }
                                                              }
                                                            }
                                                          },
                                                          "span": {
                                                            "start": 152,
                                                            "end": 169
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 152,
                                                        "end": 170
                                                      }
                                                    },
                                                    {
                                                      "kind": {
                                                        "Expression": {
                                                          "kind": {
                                                            "Assign": {
                                                              "target": {
                                                                "kind": {
                                                                  "Variable": "x"
                                                                },
                                                                "span": {
                                                                  "start": 175,
                                                                  "end": 177
                                                                }
                                                              },
                                                              "op": "Assign",
                                                              "value": {
                                                                "kind": {
                                                                  "Ternary": {
                                                                    "condition": {
                                                                      "kind": {
                                                                        "Variable": "a"
                                                                      },
                                                                      "span": {
                                                                        "start": 180,
                                                                        "end": 182
                                                                      }
                                                                    },
                                                                    "then_expr": null,
                                                                    "else_expr": {
                                                                      "kind": {
                                                                        "Variable": "c"
                                                                      },
                                                                      "span": {
                                                                        "start": 186,
                                                                        "end": 188
                                                                      }
                                                                    }
                                                                  }
                                                                },
                                                                "span": {
                                                                  "start": 180,
                                                                  "end": 188
                                                                }
                                                              }
                                                            }
                                                          },
                                                          "span": {
                                                            "start": 175,
                                                            "end": 188
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 175,
                                                        "end": 189
                                                      }
                                                    },
                                                    {
                                                      "kind": {
                                                        "Expression": {
                                                          "kind": {
                                                            "Assign": {
                                                              "target": {
                                                                "kind": {
                                                                  "Variable": "x"
                                                                },
                                                                "span": {
                                                                  "start": 194,
                                                                  "end": 196
                                                                }
                                                              },
                                                              "op": "Assign",
                                                              "value": {
                                                                "kind": {
                                                                  "NullCoalesce": {
                                                                    "left": {
                                                                      "kind": {
                                                                        "Variable": "a"
                                                                      },
                                                                      "span": {
                                                                        "start": 199,
                                                                        "end": 201
                                                                      }
                                                                    },
                                                                    "right": {
                                                                      "kind": {
                                                                        "Variable": "b"
                                                                      },
                                                                      "span": {
                                                                        "start": 205,
                                                                        "end": 207
                                                                      }
                                                                    }
                                                                  }
                                                                },
                                                                "span": {
                                                                  "start": 199,
                                                                  "end": 207
                                                                }
                                                              }
                                                            }
                                                          },
                                                          "span": {
                                                            "start": 194,
                                                            "end": 207
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 194,
                                                        "end": 208
                                                      }
                                                    },
                                                    {
                                                      "kind": {
                                                        "Expression": {
                                                          "kind": {
                                                            "Assign": {
                                                              "target": {
                                                                "kind": {
                                                                  "Array": [
                                                                    {
                                                                      "key": null,
                                                                      "kind": {
                                                                        "Value": {
                                                                          "kind": {
                                                                            "Variable": "a"
                                                                          },
                                                                          "span": {
                                                                            "start": 218,
                                                                            "end": 220
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 218,
                                                                        "end": 220
                                                                      }
                                                                    },
                                                                    {
                                                                      "key": null,
                                                                      "kind": {
                                                                        "Value": {
                                                                          "kind": {
                                                                            "Variable": "b"
                                                                          },
                                                                          "span": {
                                                                            "start": 222,
                                                                            "end": 224
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 222,
                                                                        "end": 224
                                                                      }
                                                                    },
                                                                    {
                                                                      "key": null,
                                                                      "kind": {
                                                                        "Value": {
                                                                          "kind": {
                                                                            "Variable": "c"
                                                                          },
                                                                          "span": {
                                                                            "start": 226,
                                                                            "end": 228
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 226,
                                                                        "end": 228
                                                                      }
                                                                    }
                                                                  ]
                                                                },
                                                                "span": {
                                                                  "start": 213,
                                                                  "end": 229
                                                                }
                                                              },
                                                              "op": "Assign",
                                                              "value": {
                                                                "kind": {
                                                                  "Array": [
                                                                    {
                                                                      "key": null,
                                                                      "kind": {
                                                                        "Value": {
                                                                          "kind": {
                                                                            "Int": 1
                                                                          },
                                                                          "span": {
                                                                            "start": 233,
                                                                            "end": 234
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 233,
                                                                        "end": 234
                                                                      }
                                                                    },
                                                                    {
                                                                      "key": {
                                                                        "kind": {
                                                                          "Int": 2
                                                                        },
                                                                        "span": {
                                                                          "start": 236,
                                                                          "end": 237
                                                                        }
                                                                      },
                                                                      "kind": {
                                                                        "Value": {
                                                                          "kind": {
                                                                            "String": "x"
                                                                          },
                                                                          "span": {
                                                                            "start": 239,
                                                                            "end": 242
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 236,
                                                                        "end": 242
                                                                      }
                                                                    },
                                                                    {
                                                                      "key": {
                                                                        "kind": {
                                                                          "String": "z"
                                                                        },
                                                                        "span": {
                                                                          "start": 244,
                                                                          "end": 247
                                                                        }
                                                                      },
                                                                      "kind": {
                                                                        "Value": {
                                                                          "kind": {
                                                                            "String": "c"
                                                                          },
                                                                          "span": {
                                                                            "start": 249,
                                                                            "end": 252
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 244,
                                                                        "end": 252
                                                                      }
                                                                    }
                                                                  ]
                                                                },
                                                                "span": {
                                                                  "start": 232,
                                                                  "end": 253
                                                                }
                                                              }
                                                            }
                                                          },
                                                          "span": {
                                                            "start": 213,
                                                            "end": 253
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 213,
                                                        "end": 254
                                                      }
                                                    },
                                                    {
                                                      "kind": {
                                                        "Expression": {
                                                          "kind": {
                                                            "ErrorSuppress": {
                                                              "kind": {
                                                                "FunctionCall": {
                                                                  "name": {
                                                                    "kind": {
                                                                      "Name": {
                                                                        "parts": [
                                                                          "foo"
                                                                        ],
                                                                        "kind": "Unqualified",
                                                                        "span": {
                                                                          "start": 260,
                                                                          "end": 263
                                                                        }
                                                                      }
                                                                    },
                                                                    "span": {
                                                                      "start": 260,
                                                                      "end": 263
                                                                    }
                                                                  },
                                                                  "args": []
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 260,
                                                                "end": 265
                                                              }
                                                            }
                                                          },
                                                          "span": {
                                                            "start": 259,
                                                            "end": 265
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 259,
                                                        "end": 266
                                                      }
                                                    },
                                                    {
                                                      "kind": {
                                                        "Expression": {
                                                          "kind": {
                                                            "Assign": {
                                                              "target": {
                                                                "kind": {
                                                                  "Variable": "y"
                                                                },
                                                                "span": {
                                                                  "start": 271,
                                                                  "end": 273
                                                                }
                                                              },
                                                              "op": "Assign",
                                                              "value": {
                                                                "kind": {
                                                                  "Clone": {
                                                                    "kind": {
                                                                      "Variable": "x"
                                                                    },
                                                                    "span": {
                                                                      "start": 282,
                                                                      "end": 284
                                                                    }
                                                                  }
                                                                },
                                                                "span": {
                                                                  "start": 276,
                                                                  "end": 284
                                                                }
                                                              }
                                                            }
                                                          },
                                                          "span": {
                                                            "start": 271,
                                                            "end": 284
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 271,
                                                        "end": 285
                                                      }
                                                    },
                                                    {
                                                      "kind": {
                                                        "Expression": {
                                                          "kind": {
                                                            "Yield": {
                                                              "key": {
                                                                "kind": {
                                                                  "Int": 1
                                                                },
                                                                "span": {
                                                                  "start": 296,
                                                                  "end": 297
                                                                }
                                                              },
                                                              "value": {
                                                                "kind": {
                                                                  "Int": 2
                                                                },
                                                                "span": {
                                                                  "start": 301,
                                                                  "end": 302
                                                                }
                                                              },
                                                              "is_from": false
                                                            }
                                                          },
                                                          "span": {
                                                            "start": 290,
                                                            "end": 302
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 290,
                                                        "end": 303
                                                      }
                                                    },
                                                    {
                                                      "kind": {
                                                        "Expression": {
                                                          "kind": {
                                                            "Yield": {
                                                              "key": null,
                                                              "value": {
                                                                "kind": {
                                                                  "Variable": "x"
                                                                },
                                                                "span": {
                                                                  "start": 319,
                                                                  "end": 321
                                                                }
                                                              },
                                                              "is_from": true
                                                            }
                                                          },
                                                          "span": {
                                                            "start": 308,
                                                            "end": 321
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 308,
                                                        "end": 322
                                                      }
                                                    }
                                                  ],
                                                  "attributes": []
                                                }
                                              },
                                              "span": {
                                                "start": 30,
                                                "end": 324
                                              }
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 25,
                                          "end": 324
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 24,
                                      "end": 325
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 19,
                                "end": 325
                              }
                            }
                          },
                          "span": {
                            "start": 19,
                            "end": 325
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 12,
                    "end": 326
                  }
                }
              },
              "span": {
                "start": 12,
                "end": 327
              }
            }
          ],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "AssertionError"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 337,
                    "end": 351
                  }
                }
              ],
              "var": {
                "name": "e",
                "span": {
                  "start": 352,
                  "end": 354
                }
              },
              "body": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "MethodCall": {
                            "object": {
                              "kind": {
                                "Variable": "e"
                              },
                              "span": {
                                "start": 367,
                                "end": 369
                              }
                            },
                            "method": {
                              "kind": {
                                "Identifier": "getMessage"
                              },
                              "span": {
                                "start": 371,
                                "end": 381
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 367,
                          "end": 383
                        }
                      },
                      {
                        "kind": {
                          "Name": {
                            "parts": [
                              "PHP_EOL"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 385,
                              "end": 392
                            }
                          }
                        },
                        "span": {
                          "start": 385,
                          "end": 392
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 362,
                    "end": 393
                  }
                }
              ],
              "span": {
                "start": 336,
                "end": 395
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 6,
        "end": 395
      }
    },
    {
      "kind": {
        "TryCatch": {
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "assert"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 403,
                              "end": 409
                            }
                          }
                        },
                        "span": {
                          "start": 403,
                          "end": 409
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "kind": {
                            "Value": {
                              "kind": {
                                "Binary": {
                                  "left": {
                                    "kind": {
                                      "Int": 0
                                    },
                                    "span": {
                                      "start": 410,
                                      "end": 411
                                    }
                                  },
                                  "op": "BooleanAnd",
                                  "right": {
                                    "kind": {
                                      "Parenthesized": {
                                        "kind": {
                                          "Assign": {
                                            "target": {
                                              "kind": {
                                                "Variable": "a"
                                              },
                                              "span": {
                                                "start": 416,
                                                "end": 418
                                              }
                                            },
                                            "op": "Assign",
                                            "value": {
                                              "kind": {
                                                "Closure": {
                                                  "is_static": false,
                                                  "by_ref": true,
                                                  "params": [
                                                    {
                                                      "name": {
                                                        "name": "a",
                                                        "span": {
                                                          "start": 439,
                                                          "end": 441
                                                        }
                                                      },
                                                      "type_hint": {
                                                        "kind": {
                                                          "Named": {
                                                            "parts": [
                                                              "array"
                                                            ],
                                                            "kind": "Unqualified",
                                                            "span": {
                                                              "start": 432,
                                                              "end": 437
                                                            }
                                                          }
                                                        },
                                                        "span": {
                                                          "start": 432,
                                                          "end": 437
                                                        }
                                                      },
                                                      "default": null,
                                                      "by_ref": true,
                                                      "variadic": false,
                                                      "attributes": [],
                                                      "span": {
                                                        "start": 432,
                                                        "end": 441
                                                      }
                                                    },
                                                    {
                                                      "name": {
                                                        "name": "b",
                                                        "span": {
                                                          "start": 446,
                                                          "end": 448
                                                        }
                                                      },
                                                      "type_hint": {
                                                        "kind": {
                                                          "Nullable": {
                                                            "kind": {
                                                              "Named": {
                                                                "parts": [
                                                                  "X"
                                                                ],
                                                                "kind": "Unqualified",
                                                                "span": {
                                                                  "start": 444,
                                                                  "end": 445
                                                                }
                                                              }
                                                            },
                                                            "span": {
                                                              "start": 444,
                                                              "end": 445
                                                            }
                                                          }
                                                        },
                                                        "span": {
                                                          "start": 443,
                                                          "end": 445
                                                        }
                                                      },
                                                      "default": {
                                                        "kind": "Null",
                                                        "span": {
                                                          "start": 451,
                                                          "end": 455
                                                        }
                                                      },
                                                      "by_ref": false,
                                                      "variadic": false,
                                                      "attributes": [],
                                                      "span": {
                                                        "start": 443,
                                                        "end": 455
                                                      }
                                                    }
                                                  ],
                                                  "use_vars": [
                                                    {
                                                      "name": {
                                                        "name": "c",
                                                        "span": {
                                                          "start": 462,
                                                          "end": 464
                                                        }
                                                      },
                                                      "by_ref": false,
                                                      "span": {
                                                        "start": 462,
                                                        "end": 464
                                                      }
                                                    },
                                                    {
                                                      "name": {
                                                        "name": "d",
                                                        "span": {
                                                          "start": 466,
                                                          "end": 468
                                                        }
                                                      },
                                                      "by_ref": true,
                                                      "span": {
                                                        "start": 465,
                                                        "end": 468
                                                      }
                                                    }
                                                  ],
                                                  "return_type": {
                                                    "kind": {
                                                      "Nullable": {
                                                        "kind": {
                                                          "Named": {
                                                            "parts": [
                                                              "X"
                                                            ],
                                                            "kind": "Unqualified",
                                                            "span": {
                                                              "start": 473,
                                                              "end": 474
                                                            }
                                                          }
                                                        },
                                                        "span": {
                                                          "start": 473,
                                                          "end": 474
                                                        }
                                                      }
                                                    },
                                                    "span": {
                                                      "start": 472,
                                                      "end": 474
                                                    }
                                                  },
                                                  "body": [
                                                    {
                                                      "kind": {
                                                        "Class": {
                                                          "name": {
                                                            "name": "A",
                                                            "span": {
                                                              "start": 496,
                                                              "end": 497
                                                            }
                                                          },
                                                          "modifiers": {
                                                            "is_abstract": true,
                                                            "is_final": false,
                                                            "is_readonly": false
                                                          },
                                                          "extends": {
                                                            "parts": [
                                                              "B"
                                                            ],
                                                            "kind": "Unqualified",
                                                            "span": {
                                                              "start": 506,
                                                              "end": 507
                                                            }
                                                          },
                                                          "implements": [
                                                            {
                                                              "parts": [
                                                                "C"
                                                              ],
                                                              "kind": "Unqualified",
                                                              "span": {
                                                                "start": 519,
                                                                "end": 520
                                                              }
                                                            },
                                                            {
                                                              "parts": [
                                                                "D"
                                                              ],
                                                              "kind": "Unqualified",
                                                              "span": {
                                                                "start": 522,
                                                                "end": 523
                                                              }
                                                            }
                                                          ],
                                                          "members": [
                                                            {
                                                              "kind": {
                                                                "ClassConst": {
                                                                  "name": {
                                                                    "name": "X",
                                                                    "span": {
                                                                      "start": 540,
                                                                      "end": 541
                                                                    }
                                                                  },
                                                                  "value": {
                                                                    "kind": {
                                                                      "Int": 12
                                                                    },
                                                                    "span": {
                                                                      "start": 544,
                                                                      "end": 546
                                                                    }
                                                                  },
                                                                  "attributes": []
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 534,
                                                                "end": 547
                                                              }
                                                            },
                                                            {
                                                              "kind": {
                                                                "ClassConst": {
                                                                  "name": {
                                                                    "name": "Y",
                                                                    "span": {
                                                                      "start": 562,
                                                                      "end": 563
                                                                    }
                                                                  },
                                                                  "value": {
                                                                    "kind": {
                                                                      "ClassConstAccess": {
                                                                        "class": {
                                                                          "kind": {
                                                                            "Name": {
                                                                              "parts": [
                                                                                "self"
                                                                              ],
                                                                              "kind": "Unqualified",
                                                                              "span": {
                                                                                "start": 566,
                                                                                "end": 570
                                                                              }
                                                                            }
                                                                          },
                                                                          "span": {
                                                                            "start": 566,
                                                                            "end": 570
                                                                          }
                                                                        },
                                                                        "member": {
                                                                          "kind": {
                                                                            "Identifier": "X"
                                                                          },
                                                                          "span": {
                                                                            "start": 572,
                                                                            "end": 573
                                                                          }
                                                                        }
                                                                      }
                                                                    },
                                                                    "span": {
                                                                      "start": 566,
                                                                      "end": 573
                                                                    }
                                                                  },
                                                                  "attributes": []
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 556,
                                                                "end": 585
                                                              }
                                                            },
                                                            {
                                                              "kind": {
                                                                "ClassConst": {
                                                                  "name": {
                                                                    "name": "Z",
                                                                    "span": {
                                                                      "start": 575,
                                                                      "end": 576
                                                                    }
                                                                  },
                                                                  "value": {
                                                                    "kind": {
                                                                      "String": "aaa"
                                                                    },
                                                                    "span": {
                                                                      "start": 579,
                                                                      "end": 584
                                                                    }
                                                                  },
                                                                  "attributes": []
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 556,
                                                                "end": 585
                                                              }
                                                            },
                                                            {
                                                              "kind": {
                                                                "Property": {
                                                                  "name": {
                                                                    "name": "a",
                                                                    "span": {
                                                                      "start": 602,
                                                                      "end": 604
                                                                    }
                                                                  },
                                                                  "modifiers": {
                                                                    "visibility": "Public"
                                                                  },
                                                                  "type_hint": null,
                                                                  "default": {
                                                                    "kind": {
                                                                      "Int": 1
                                                                    },
                                                                    "span": {
                                                                      "start": 607,
                                                                      "end": 608
                                                                    }
                                                                  },
                                                                  "attributes": []
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 595,
                                                                "end": 608
                                                              }
                                                            },
                                                            {
                                                              "kind": {
                                                                "Property": {
                                                                  "name": {
                                                                    "name": "b",
                                                                    "span": {
                                                                      "start": 610,
                                                                      "end": 612
                                                                    }
                                                                  },
                                                                  "modifiers": {
                                                                    "visibility": "Public"
                                                                  },
                                                                  "type_hint": null,
                                                                  "default": null,
                                                                  "attributes": []
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 595,
                                                                "end": 612
                                                              }
                                                            },
                                                            {
                                                              "kind": {
                                                                "Property": {
                                                                  "name": {
                                                                    "name": "c",
                                                                    "span": {
                                                                      "start": 632,
                                                                      "end": 634
                                                                    }
                                                                  },
                                                                  "modifiers": {
                                                                    "visibility": "Protected"
                                                                  },
                                                                  "type_hint": null,
                                                                  "default": null,
                                                                  "attributes": []
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 622,
                                                                "end": 634
                                                              }
                                                            },
                                                            {
                                                              "kind": {
                                                                "Property": {
                                                                  "name": {
                                                                    "name": "d",
                                                                    "span": {
                                                                      "start": 659,
                                                                      "end": 661
                                                                    }
                                                                  },
                                                                  "modifiers": {
                                                                    "visibility": "Private",
                                                                    "is_static": true
                                                                  },
                                                                  "type_hint": null,
                                                                  "default": {
                                                                    "kind": "Null",
                                                                    "span": {
                                                                      "start": 664,
                                                                      "end": 668
                                                                    }
                                                                  },
                                                                  "attributes": []
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 644,
                                                                "end": 668
                                                              }
                                                            },
                                                            {
                                                              "kind": {
                                                                "Method": {
                                                                  "name": {
                                                                    "name": "foo",
                                                                    "span": {
                                                                      "start": 697,
                                                                      "end": 700
                                                                    }
                                                                  },
                                                                  "modifiers": {
                                                                    "is_abstract": true
                                                                  },
                                                                  "by_ref": false,
                                                                  "params": [],
                                                                  "return_type": null,
                                                                  "body": null,
                                                                  "attributes": []
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 679,
                                                                "end": 703
                                                              }
                                                            },
                                                            {
                                                              "kind": {
                                                                "Method": {
                                                                  "name": {
                                                                    "name": "f1",
                                                                    "span": {
                                                                      "start": 737,
                                                                      "end": 739
                                                                    }
                                                                  },
                                                                  "modifiers": {
                                                                    "visibility": "Private",
                                                                    "is_static": true
                                                                  },
                                                                  "by_ref": false,
                                                                  "params": [],
                                                                  "return_type": null,
                                                                  "body": [
                                                                    {
                                                                      "kind": {
                                                                        "For": {
                                                                          "init": [
                                                                            {
                                                                              "kind": {
                                                                                "Assign": {
                                                                                  "target": {
                                                                                    "kind": {
                                                                                      "Variable": "i"
                                                                                    },
                                                                                    "span": {
                                                                                      "start": 761,
                                                                                      "end": 763
                                                                                    }
                                                                                  },
                                                                                  "op": "Assign",
                                                                                  "value": {
                                                                                    "kind": {
                                                                                      "Int": 0
                                                                                    },
                                                                                    "span": {
                                                                                      "start": 766,
                                                                                      "end": 767
                                                                                    }
                                                                                  }
                                                                                }
                                                                              },
                                                                              "span": {
                                                                                "start": 761,
                                                                                "end": 767
                                                                              }
                                                                            },
                                                                            {
                                                                              "kind": {
                                                                                "Assign": {
                                                                                  "target": {
                                                                                    "kind": {
                                                                                      "Variable": "j"
                                                                                    },
                                                                                    "span": {
                                                                                      "start": 769,
                                                                                      "end": 771
                                                                                    }
                                                                                  },
                                                                                  "op": "Assign",
                                                                                  "value": {
                                                                                    "kind": {
                                                                                      "Int": 100
                                                                                    },
                                                                                    "span": {
                                                                                      "start": 774,
                                                                                      "end": 777
                                                                                    }
                                                                                  }
                                                                                }
                                                                              },
                                                                              "span": {
                                                                                "start": 769,
                                                                                "end": 777
                                                                              }
                                                                            }
                                                                          ],
                                                                          "condition": [
                                                                            {
                                                                              "kind": {
                                                                                "Binary": {
                                                                                  "left": {
                                                                                    "kind": {
                                                                                      "Variable": "i"
                                                                                    },
                                                                                    "span": {
                                                                                      "start": 779,
                                                                                      "end": 781
                                                                                    }
                                                                                  },
                                                                                  "op": "Less",
                                                                                  "right": {
                                                                                    "kind": {
                                                                                      "Variable": "j"
                                                                                    },
                                                                                    "span": {
                                                                                      "start": 784,
                                                                                      "end": 786
                                                                                    }
                                                                                  }
                                                                                }
                                                                              },
                                                                              "span": {
                                                                                "start": 779,
                                                                                "end": 786
                                                                              }
                                                                            }
                                                                          ],
                                                                          "update": [
                                                                            {
                                                                              "kind": {
                                                                                "UnaryPostfix": {
                                                                                  "operand": {
                                                                                    "kind": {
                                                                                      "Variable": "i"
                                                                                    },
                                                                                    "span": {
                                                                                      "start": 788,
                                                                                      "end": 790
                                                                                    }
                                                                                  },
                                                                                  "op": "PostIncrement"
                                                                                }
                                                                              },
                                                                              "span": {
                                                                                "start": 788,
                                                                                "end": 792
                                                                              }
                                                                            },
                                                                            {
                                                                              "kind": {
                                                                                "UnaryPrefix": {
                                                                                  "op": "PreDecrement",
                                                                                  "operand": {
                                                                                    "kind": {
                                                                                      "Variable": "j"
                                                                                    },
                                                                                    "span": {
                                                                                      "start": 796,
                                                                                      "end": 798
                                                                                    }
                                                                                  }
                                                                                }
                                                                              },
                                                                              "span": {
                                                                                "start": 794,
                                                                                "end": 798
                                                                              }
                                                                            }
                                                                          ],
                                                                          "body": {
                                                                            "kind": {
                                                                              "Block": [
                                                                                {
                                                                                  "kind": {
                                                                                    "Expression": {
                                                                                      "kind": {
                                                                                        "Assign": {
                                                                                          "target": {
                                                                                            "kind": {
                                                                                              "ArrayAccess": {
                                                                                                "array": {
                                                                                                  "kind": {
                                                                                                    "Variable": "s"
                                                                                                  },
                                                                                                  "span": {
                                                                                                    "start": 818,
                                                                                                    "end": 820
                                                                                                  }
                                                                                                },
                                                                                                "index": {
                                                                                                  "kind": {
                                                                                                    "Variable": "i"
                                                                                                  },
                                                                                                  "span": {
                                                                                                    "start": 821,
                                                                                                    "end": 823
                                                                                                  }
                                                                                                }
                                                                                              }
                                                                                            },
                                                                                            "span": {
                                                                                              "start": 818,
                                                                                              "end": 824
                                                                                            }
                                                                                          },
                                                                                          "op": "Assign",
                                                                                          "value": {
                                                                                            "kind": {
                                                                                              "ArrayAccess": {
                                                                                                "array": {
                                                                                                  "kind": {
                                                                                                    "Variable": "a"
                                                                                                  },
                                                                                                  "span": {
                                                                                                    "start": 827,
                                                                                                    "end": 829
                                                                                                  }
                                                                                                },
                                                                                                "index": {
                                                                                                  "kind": {
                                                                                                    "Variable": "j"
                                                                                                  },
                                                                                                  "span": {
                                                                                                    "start": 830,
                                                                                                    "end": 832
                                                                                                  }
                                                                                                }
                                                                                              }
                                                                                            },
                                                                                            "span": {
                                                                                              "start": 827,
                                                                                              "end": 833
                                                                                            }
                                                                                          }
                                                                                        }
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 818,
                                                                                        "end": 833
                                                                                      }
                                                                                    }
                                                                                  },
                                                                                  "span": {
                                                                                    "start": 818,
                                                                                    "end": 834
                                                                                  }
                                                                                }
                                                                              ]
                                                                            },
                                                                            "span": {
                                                                              "start": 800,
                                                                              "end": 848
                                                                            }
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 756,
                                                                        "end": 848
                                                                      }
                                                                    },
                                                                    {
                                                                      "kind": {
                                                                        "Foreach": {
                                                                          "expr": {
                                                                            "kind": {
                                                                              "Variable": "a"
                                                                            },
                                                                            "span": {
                                                                              "start": 870,
                                                                              "end": 872
                                                                            }
                                                                          },
                                                                          "key": {
                                                                            "kind": {
                                                                              "Variable": "key"
                                                                            },
                                                                            "span": {
                                                                              "start": 876,
                                                                              "end": 880
                                                                            }
                                                                          },
                                                                          "value": {
                                                                            "kind": {
                                                                              "Variable": "val"
                                                                            },
                                                                            "span": {
                                                                              "start": 885,
                                                                              "end": 889
                                                                            }
                                                                          },
                                                                          "by_ref": true,
                                                                          "body": {
                                                                            "kind": {
                                                                              "Block": [
                                                                                {
                                                                                  "kind": {
                                                                                    "Expression": {
                                                                                      "kind": {
                                                                                        "Print": {
                                                                                          "kind": {
                                                                                            "InterpolatedString": [
                                                                                              {
                                                                                                "Expr": {
                                                                                                  "kind": {
                                                                                                    "Variable": "key"
                                                                                                  },
                                                                                                  "span": {
                                                                                                    "start": 916,
                                                                                                    "end": 920
                                                                                                  }
                                                                                                }
                                                                                              },
                                                                                              {
                                                                                                "Literal": " => "
                                                                                              },
                                                                                              {
                                                                                                "Expr": {
                                                                                                  "kind": {
                                                                                                    "Variable": "val"
                                                                                                  },
                                                                                                  "span": {
                                                                                                    "start": 924,
                                                                                                    "end": 928
                                                                                                  }
                                                                                                }
                                                                                              },
                                                                                              {
                                                                                                "Literal": "\n"
                                                                                              }
                                                                                            ]
                                                                                          },
                                                                                          "span": {
                                                                                            "start": 915,
                                                                                            "end": 931
                                                                                          }
                                                                                        }
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 909,
                                                                                        "end": 931
                                                                                      }
                                                                                    }
                                                                                  },
                                                                                  "span": {
                                                                                    "start": 909,
                                                                                    "end": 932
                                                                                  }
                                                                                }
                                                                              ]
                                                                            },
                                                                            "span": {
                                                                              "start": 891,
                                                                              "end": 946
                                                                            }
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 861,
                                                                        "end": 946
                                                                      }
                                                                    },
                                                                    {
                                                                      "kind": {
                                                                        "While": {
                                                                          "condition": {
                                                                            "kind": {
                                                                              "ArrayAccess": {
                                                                                "array": {
                                                                                  "kind": {
                                                                                    "Variable": "s"
                                                                                  },
                                                                                  "span": {
                                                                                    "start": 966,
                                                                                    "end": 968
                                                                                  }
                                                                                },
                                                                                "index": {
                                                                                  "kind": {
                                                                                    "Variable": "i"
                                                                                  },
                                                                                  "span": {
                                                                                    "start": 969,
                                                                                    "end": 971
                                                                                  }
                                                                                }
                                                                              }
                                                                            },
                                                                            "span": {
                                                                              "start": 966,
                                                                              "end": 972
                                                                            }
                                                                          },
                                                                          "body": {
                                                                            "kind": {
                                                                              "Block": [
                                                                                {
                                                                                  "kind": {
                                                                                    "Expression": {
                                                                                      "kind": {
                                                                                        "UnaryPostfix": {
                                                                                          "operand": {
                                                                                            "kind": {
                                                                                              "Variable": "i"
                                                                                            },
                                                                                            "span": {
                                                                                              "start": 992,
                                                                                              "end": 994
                                                                                            }
                                                                                          },
                                                                                          "op": "PostIncrement"
                                                                                        }
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 992,
                                                                                        "end": 996
                                                                                      }
                                                                                    }
                                                                                  },
                                                                                  "span": {
                                                                                    "start": 992,
                                                                                    "end": 997
                                                                                  }
                                                                                }
                                                                              ]
                                                                            },
                                                                            "span": {
                                                                              "start": 974,
                                                                              "end": 1011
                                                                            }
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 959,
                                                                        "end": 1011
                                                                      }
                                                                    },
                                                                    {
                                                                      "kind": {
                                                                        "DoWhile": {
                                                                          "body": {
                                                                            "kind": {
                                                                              "Block": [
                                                                                {
                                                                                  "kind": {
                                                                                    "Expression": {
                                                                                      "kind": {
                                                                                        "UnaryPostfix": {
                                                                                          "operand": {
                                                                                            "kind": {
                                                                                              "Variable": "i"
                                                                                            },
                                                                                            "span": {
                                                                                              "start": 1045,
                                                                                              "end": 1047
                                                                                            }
                                                                                          },
                                                                                          "op": "PostDecrement"
                                                                                        }
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 1045,
                                                                                        "end": 1049
                                                                                      }
                                                                                    }
                                                                                  },
                                                                                  "span": {
                                                                                    "start": 1045,
                                                                                    "end": 1050
                                                                                  }
                                                                                }
                                                                              ]
                                                                            },
                                                                            "span": {
                                                                              "start": 1027,
                                                                              "end": 1064
                                                                            }
                                                                          },
                                                                          "condition": {
                                                                            "kind": {
                                                                              "ArrayAccess": {
                                                                                "array": {
                                                                                  "kind": {
                                                                                    "Variable": "s"
                                                                                  },
                                                                                  "span": {
                                                                                    "start": 1072,
                                                                                    "end": 1074
                                                                                  }
                                                                                },
                                                                                "index": {
                                                                                  "kind": {
                                                                                    "Variable": "i"
                                                                                  },
                                                                                  "span": {
                                                                                    "start": 1075,
                                                                                    "end": 1077
                                                                                  }
                                                                                }
                                                                              }
                                                                            },
                                                                            "span": {
                                                                              "start": 1072,
                                                                              "end": 1078
                                                                            }
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 1024,
                                                                        "end": 1080
                                                                      }
                                                                    },
                                                                    {
                                                                      "kind": {
                                                                        "Expression": {
                                                                          "kind": {
                                                                            "Assign": {
                                                                              "target": {
                                                                                "kind": {
                                                                                  "Variable": "x"
                                                                                },
                                                                                "span": {
                                                                                  "start": 1093,
                                                                                  "end": 1095
                                                                                }
                                                                              },
                                                                              "op": "Assign",
                                                                              "value": {
                                                                                "kind": {
                                                                                  "FunctionCall": {
                                                                                    "name": {
                                                                                      "kind": {
                                                                                        "Name": {
                                                                                          "parts": [
                                                                                            "foo"
                                                                                          ],
                                                                                          "kind": "Unqualified",
                                                                                          "span": {
                                                                                            "start": 1098,
                                                                                            "end": 1101
                                                                                          }
                                                                                        }
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 1098,
                                                                                        "end": 1101
                                                                                      }
                                                                                    },
                                                                                    "args": [
                                                                                      {
                                                                                        "name": null,
                                                                                        "kind": {
                                                                                          "Value": {
                                                                                            "kind": {
                                                                                              "Binary": {
                                                                                                "left": {
                                                                                                  "kind": {
                                                                                                    "Variable": "a"
                                                                                                  },
                                                                                                  "span": {
                                                                                                    "start": 1102,
                                                                                                    "end": 1104
                                                                                                  }
                                                                                                },
                                                                                                "op": "Add",
                                                                                                "right": {
                                                                                                  "kind": {
                                                                                                    "Int": 1
                                                                                                  },
                                                                                                  "span": {
                                                                                                    "start": 1107,
                                                                                                    "end": 1108
                                                                                                  }
                                                                                                }
                                                                                              }
                                                                                            },
                                                                                            "span": {
                                                                                              "start": 1102,
                                                                                              "end": 1108
                                                                                            }
                                                                                          }
                                                                                        },
                                                                                        "span": {
                                                                                          "start": 1102,
                                                                                          "end": 1108
                                                                                        }
                                                                                      },
                                                                                      {
                                                                                        "name": null,
                                                                                        "kind": {
                                                                                          "Value": {
                                                                                            "kind": {
                                                                                              "Int": 4
                                                                                            },
                                                                                            "span": {
                                                                                              "start": 1110,
                                                                                              "end": 1111
                                                                                            }
                                                                                          }
                                                                                        },
                                                                                        "span": {
                                                                                          "start": 1110,
                                                                                          "end": 1111
                                                                                        }
                                                                                      },
                                                                                      {
                                                                                        "name": null,
                                                                                        "kind": {
                                                                                          "Spread": {
                                                                                            "kind": {
                                                                                              "Array": [
                                                                                                {
                                                                                                  "key": null,
                                                                                                  "kind": {
                                                                                                    "Value": {
                                                                                                      "kind": {
                                                                                                        "Int": 1
                                                                                                      },
                                                                                                      "span": {
                                                                                                        "start": 1117,
                                                                                                        "end": 1118
                                                                                                      }
                                                                                                    }
                                                                                                  },
                                                                                                  "span": {
                                                                                                    "start": 1117,
                                                                                                    "end": 1118
                                                                                                  }
                                                                                                },
                                                                                                {
                                                                                                  "key": null,
                                                                                                  "kind": {
                                                                                                    "Value": {
                                                                                                      "kind": {
                                                                                                        "Int": 2
                                                                                                      },
                                                                                                      "span": {
                                                                                                        "start": 1119,
                                                                                                        "end": 1120
                                                                                                      }
                                                                                                    }
                                                                                                  },
                                                                                                  "span": {
                                                                                                    "start": 1119,
                                                                                                    "end": 1120
                                                                                                  }
                                                                                                },
                                                                                                {
                                                                                                  "key": null,
                                                                                                  "kind": {
                                                                                                    "Value": {
                                                                                                      "kind": {
                                                                                                        "Int": 3
                                                                                                      },
                                                                                                      "span": {
                                                                                                        "start": 1121,
                                                                                                        "end": 1122
                                                                                                      }
                                                                                                    }
                                                                                                  },
                                                                                                  "span": {
                                                                                                    "start": 1121,
                                                                                                    "end": 1122
                                                                                                  }
                                                                                                }
                                                                                              ]
                                                                                            },
                                                                                            "span": {
                                                                                              "start": 1116,
                                                                                              "end": 1123
                                                                                            }
                                                                                          }
                                                                                        },
                                                                                        "span": {
                                                                                          "start": 1113,
                                                                                          "end": 1123
                                                                                        }
                                                                                      }
                                                                                    ]
                                                                                  }
                                                                                },
                                                                                "span": {
                                                                                  "start": 1098,
                                                                                  "end": 1124
                                                                                }
                                                                              }
                                                                            }
                                                                          },
                                                                          "span": {
                                                                            "start": 1093,
                                                                            "end": 1124
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 1093,
                                                                        "end": 1125
                                                                      }
                                                                    },
                                                                    {
                                                                      "kind": {
                                                                        "Expression": {
                                                                          "kind": {
                                                                            "Assign": {
                                                                              "target": {
                                                                                "kind": {
                                                                                  "Variable": "x"
                                                                                },
                                                                                "span": {
                                                                                  "start": 1138,
                                                                                  "end": 1140
                                                                                }
                                                                              },
                                                                              "op": "Assign",
                                                                              "value": {
                                                                                "kind": {
                                                                                  "FunctionCall": {
                                                                                    "name": {
                                                                                      "kind": {
                                                                                        "VariableVariable": {
                                                                                          "kind": {
                                                                                            "Binary": {
                                                                                              "left": {
                                                                                                "kind": {
                                                                                                  "Variable": "a"
                                                                                                },
                                                                                                "span": {
                                                                                                  "start": 1145,
                                                                                                  "end": 1147
                                                                                                }
                                                                                              },
                                                                                              "op": "Concat",
                                                                                              "right": {
                                                                                                "kind": {
                                                                                                  "String": "_1"
                                                                                                },
                                                                                                "span": {
                                                                                                  "start": 1150,
                                                                                                  "end": 1154
                                                                                                }
                                                                                              }
                                                                                            }
                                                                                          },
                                                                                          "span": {
                                                                                            "start": 1145,
                                                                                            "end": 1154
                                                                                          }
                                                                                        }
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 1143,
                                                                                        "end": 1155
                                                                                      }
                                                                                    },
                                                                                    "args": []
                                                                                  }
                                                                                },
                                                                                "span": {
                                                                                  "start": 1143,
                                                                                  "end": 1157
                                                                                }
                                                                              }
                                                                            }
                                                                          },
                                                                          "span": {
                                                                            "start": 1138,
                                                                            "end": 1157
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 1138,
                                                                        "end": 1158
                                                                      }
                                                                    },
                                                                    {
                                                                      "kind": {
                                                                        "Expression": {
                                                                          "kind": {
                                                                            "Assign": {
                                                                              "target": {
                                                                                "kind": {
                                                                                  "Variable": "x"
                                                                                },
                                                                                "span": {
                                                                                  "start": 1171,
                                                                                  "end": 1173
                                                                                }
                                                                              },
                                                                              "op": "Assign",
                                                                              "value": {
                                                                                "kind": {
                                                                                  "StaticMethodCall": {
                                                                                    "class": {
                                                                                      "kind": {
                                                                                        "Name": {
                                                                                          "parts": [
                                                                                            "A"
                                                                                          ],
                                                                                          "kind": "Unqualified",
                                                                                          "span": {
                                                                                            "start": 1176,
                                                                                            "end": 1177
                                                                                          }
                                                                                        }
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 1176,
                                                                                        "end": 1177
                                                                                      }
                                                                                    },
                                                                                    "method": {
                                                                                      "kind": {
                                                                                        "Identifier": "foo"
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 1179,
                                                                                        "end": 1182
                                                                                      }
                                                                                    },
                                                                                    "args": []
                                                                                  }
                                                                                },
                                                                                "span": {
                                                                                  "start": 1176,
                                                                                  "end": 1184
                                                                                }
                                                                              }
                                                                            }
                                                                          },
                                                                          "span": {
                                                                            "start": 1171,
                                                                            "end": 1184
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 1171,
                                                                        "end": 1185
                                                                      }
                                                                    },
                                                                    {
                                                                      "kind": {
                                                                        "Expression": {
                                                                          "kind": {
                                                                            "Assign": {
                                                                              "target": {
                                                                                "kind": {
                                                                                  "Variable": "x"
                                                                                },
                                                                                "span": {
                                                                                  "start": 1198,
                                                                                  "end": 1200
                                                                                }
                                                                              },
                                                                              "op": "Assign",
                                                                              "value": {
                                                                                "kind": {
                                                                                  "StaticMethodCall": {
                                                                                    "class": {
                                                                                      "kind": {
                                                                                        "VariableVariable": {
                                                                                          "kind": {
                                                                                            "Binary": {
                                                                                              "left": {
                                                                                                "kind": {
                                                                                                  "Variable": "a"
                                                                                                },
                                                                                                "span": {
                                                                                                  "start": 1205,
                                                                                                  "end": 1207
                                                                                                }
                                                                                              },
                                                                                              "op": "Concat",
                                                                                              "right": {
                                                                                                "kind": {
                                                                                                  "String": "_1"
                                                                                                },
                                                                                                "span": {
                                                                                                  "start": 1210,
                                                                                                  "end": 1214
                                                                                                }
                                                                                              }
                                                                                            }
                                                                                          },
                                                                                          "span": {
                                                                                            "start": 1205,
                                                                                            "end": 1214
                                                                                          }
                                                                                        }
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 1203,
                                                                                        "end": 1215
                                                                                      }
                                                                                    },
                                                                                    "method": {
                                                                                      "kind": {
                                                                                        "Identifier": "foo"
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 1217,
                                                                                        "end": 1220
                                                                                      }
                                                                                    },
                                                                                    "args": []
                                                                                  }
                                                                                },
                                                                                "span": {
                                                                                  "start": 1203,
                                                                                  "end": 1222
                                                                                }
                                                                              }
                                                                            }
                                                                          },
                                                                          "span": {
                                                                            "start": 1198,
                                                                            "end": 1222
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 1198,
                                                                        "end": 1223
                                                                      }
                                                                    },
                                                                    {
                                                                      "kind": {
                                                                        "Expression": {
                                                                          "kind": {
                                                                            "Assign": {
                                                                              "target": {
                                                                                "kind": {
                                                                                  "Variable": "x"
                                                                                },
                                                                                "span": {
                                                                                  "start": 1236,
                                                                                  "end": 1238
                                                                                }
                                                                              },
                                                                              "op": "Assign",
                                                                              "value": {
                                                                                "kind": {
                                                                                  "FunctionCall": {
                                                                                    "name": {
                                                                                      "kind": {
                                                                                        "StaticPropertyAccessDynamic": {
                                                                                          "class": {
                                                                                            "kind": {
                                                                                              "Name": {
                                                                                                "parts": [
                                                                                                  "A"
                                                                                                ],
                                                                                                "kind": "Unqualified",
                                                                                                "span": {
                                                                                                  "start": 1241,
                                                                                                  "end": 1242
                                                                                                }
                                                                                              }
                                                                                            },
                                                                                            "span": {
                                                                                              "start": 1241,
                                                                                              "end": 1242
                                                                                            }
                                                                                          },
                                                                                          "member": {
                                                                                            "kind": {
                                                                                              "VariableVariable": {
                                                                                                "kind": {
                                                                                                  "Binary": {
                                                                                                    "left": {
                                                                                                      "kind": {
                                                                                                        "Variable": "a"
                                                                                                      },
                                                                                                      "span": {
                                                                                                        "start": 1246,
                                                                                                        "end": 1248
                                                                                                      }
                                                                                                    },
                                                                                                    "op": "Concat",
                                                                                                    "right": {
                                                                                                      "kind": {
                                                                                                        "String": "_1"
                                                                                                      },
                                                                                                      "span": {
                                                                                                        "start": 1251,
                                                                                                        "end": 1255
                                                                                                      }
                                                                                                    }
                                                                                                  }
                                                                                                },
                                                                                                "span": {
                                                                                                  "start": 1246,
                                                                                                  "end": 1255
                                                                                                }
                                                                                              }
                                                                                            },
                                                                                            "span": {
                                                                                              "start": 1244,
                                                                                              "end": 1256
                                                                                            }
                                                                                          }
                                                                                        }
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 1241,
                                                                                        "end": 1256
                                                                                      }
                                                                                    },
                                                                                    "args": []
                                                                                  }
                                                                                },
                                                                                "span": {
                                                                                  "start": 1241,
                                                                                  "end": 1258
                                                                                }
                                                                              }
                                                                            }
                                                                          },
                                                                          "span": {
                                                                            "start": 1236,
                                                                            "end": 1258
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 1236,
                                                                        "end": 1259
                                                                      }
                                                                    },
                                                                    {
                                                                      "kind": {
                                                                        "Expression": {
                                                                          "kind": {
                                                                            "Assign": {
                                                                              "target": {
                                                                                "kind": {
                                                                                  "Variable": "x"
                                                                                },
                                                                                "span": {
                                                                                  "start": 1272,
                                                                                  "end": 1274
                                                                                }
                                                                              },
                                                                              "op": "Assign",
                                                                              "value": {
                                                                                "kind": {
                                                                                  "MethodCall": {
                                                                                    "object": {
                                                                                      "kind": {
                                                                                        "Variable": "x"
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 1277,
                                                                                        "end": 1279
                                                                                      }
                                                                                    },
                                                                                    "method": {
                                                                                      "kind": {
                                                                                        "Identifier": "foo"
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 1281,
                                                                                        "end": 1284
                                                                                      }
                                                                                    },
                                                                                    "args": []
                                                                                  }
                                                                                },
                                                                                "span": {
                                                                                  "start": 1277,
                                                                                  "end": 1286
                                                                                }
                                                                              }
                                                                            }
                                                                          },
                                                                          "span": {
                                                                            "start": 1272,
                                                                            "end": 1286
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 1272,
                                                                        "end": 1287
                                                                      }
                                                                    },
                                                                    {
                                                                      "kind": {
                                                                        "Expression": {
                                                                          "kind": {
                                                                            "Assign": {
                                                                              "target": {
                                                                                "kind": {
                                                                                  "Variable": "x"
                                                                                },
                                                                                "span": {
                                                                                  "start": 1300,
                                                                                  "end": 1302
                                                                                }
                                                                              },
                                                                              "op": "Assign",
                                                                              "value": {
                                                                                "kind": {
                                                                                  "MethodCall": {
                                                                                    "object": {
                                                                                      "kind": {
                                                                                        "VariableVariable": {
                                                                                          "kind": {
                                                                                            "Binary": {
                                                                                              "left": {
                                                                                                "kind": {
                                                                                                  "Variable": "a"
                                                                                                },
                                                                                                "span": {
                                                                                                  "start": 1307,
                                                                                                  "end": 1309
                                                                                                }
                                                                                              },
                                                                                              "op": "Concat",
                                                                                              "right": {
                                                                                                "kind": {
                                                                                                  "String": "_1"
                                                                                                },
                                                                                                "span": {
                                                                                                  "start": 1312,
                                                                                                  "end": 1316
                                                                                                }
                                                                                              }
                                                                                            }
                                                                                          },
                                                                                          "span": {
                                                                                            "start": 1307,
                                                                                            "end": 1316
                                                                                          }
                                                                                        }
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 1305,
                                                                                        "end": 1317
                                                                                      }
                                                                                    },
                                                                                    "method": {
                                                                                      "kind": {
                                                                                        "Identifier": "foo"
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 1319,
                                                                                        "end": 1322
                                                                                      }
                                                                                    },
                                                                                    "args": []
                                                                                  }
                                                                                },
                                                                                "span": {
                                                                                  "start": 1305,
                                                                                  "end": 1324
                                                                                }
                                                                              }
                                                                            }
                                                                          },
                                                                          "span": {
                                                                            "start": 1300,
                                                                            "end": 1324
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 1300,
                                                                        "end": 1325
                                                                      }
                                                                    },
                                                                    {
                                                                      "kind": {
                                                                        "Expression": {
                                                                          "kind": {
                                                                            "Assign": {
                                                                              "target": {
                                                                                "kind": {
                                                                                  "Variable": "x"
                                                                                },
                                                                                "span": {
                                                                                  "start": 1338,
                                                                                  "end": 1340
                                                                                }
                                                                              },
                                                                              "op": "Assign",
                                                                              "value": {
                                                                                "kind": {
                                                                                  "MethodCall": {
                                                                                    "object": {
                                                                                      "kind": {
                                                                                        "Variable": "x"
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 1343,
                                                                                        "end": 1345
                                                                                      }
                                                                                    },
                                                                                    "method": {
                                                                                      "kind": {
                                                                                        "Binary": {
                                                                                          "left": {
                                                                                            "kind": {
                                                                                              "Variable": "a"
                                                                                            },
                                                                                            "span": {
                                                                                              "start": 1348,
                                                                                              "end": 1350
                                                                                            }
                                                                                          },
                                                                                          "op": "Concat",
                                                                                          "right": {
                                                                                            "kind": {
                                                                                              "String": "_1"
                                                                                            },
                                                                                            "span": {
                                                                                              "start": 1353,
                                                                                              "end": 1357
                                                                                            }
                                                                                          }
                                                                                        }
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 1348,
                                                                                        "end": 1357
                                                                                      }
                                                                                    },
                                                                                    "args": []
                                                                                  }
                                                                                },
                                                                                "span": {
                                                                                  "start": 1343,
                                                                                  "end": 1360
                                                                                }
                                                                              }
                                                                            }
                                                                          },
                                                                          "span": {
                                                                            "start": 1338,
                                                                            "end": 1360
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 1338,
                                                                        "end": 1361
                                                                      }
                                                                    },
                                                                    {
                                                                      "kind": {
                                                                        "Expression": {
                                                                          "kind": {
                                                                            "Assign": {
                                                                              "target": {
                                                                                "kind": {
                                                                                  "PropertyAccess": {
                                                                                    "object": {
                                                                                      "kind": {
                                                                                        "Variable": "x"
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 1374,
                                                                                        "end": 1376
                                                                                      }
                                                                                    },
                                                                                    "property": {
                                                                                      "kind": {
                                                                                        "Identifier": "a"
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 1378,
                                                                                        "end": 1379
                                                                                      }
                                                                                    }
                                                                                  }
                                                                                },
                                                                                "span": {
                                                                                  "start": 1374,
                                                                                  "end": 1379
                                                                                }
                                                                              },
                                                                              "op": "Assign",
                                                                              "value": {
                                                                                "kind": {
                                                                                  "ClassConstAccess": {
                                                                                    "class": {
                                                                                      "kind": {
                                                                                        "Name": {
                                                                                          "parts": [
                                                                                            "C"
                                                                                          ],
                                                                                          "kind": "Unqualified",
                                                                                          "span": {
                                                                                            "start": 1382,
                                                                                            "end": 1383
                                                                                          }
                                                                                        }
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 1382,
                                                                                        "end": 1383
                                                                                      }
                                                                                    },
                                                                                    "member": {
                                                                                      "kind": {
                                                                                        "Identifier": "C"
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 1385,
                                                                                        "end": 1386
                                                                                      }
                                                                                    }
                                                                                  }
                                                                                },
                                                                                "span": {
                                                                                  "start": 1382,
                                                                                  "end": 1386
                                                                                }
                                                                              }
                                                                            }
                                                                          },
                                                                          "span": {
                                                                            "start": 1374,
                                                                            "end": 1386
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 1374,
                                                                        "end": 1387
                                                                      }
                                                                    },
                                                                    {
                                                                      "kind": {
                                                                        "Expression": {
                                                                          "kind": {
                                                                            "Assign": {
                                                                              "target": {
                                                                                "kind": {
                                                                                  "PropertyAccess": {
                                                                                    "object": {
                                                                                      "kind": {
                                                                                        "VariableVariable": {
                                                                                          "kind": {
                                                                                            "Binary": {
                                                                                              "left": {
                                                                                                "kind": {
                                                                                                  "Variable": "a"
                                                                                                },
                                                                                                "span": {
                                                                                                  "start": 1402,
                                                                                                  "end": 1404
                                                                                                }
                                                                                              },
                                                                                              "op": "Concat",
                                                                                              "right": {
                                                                                                "kind": {
                                                                                                  "String": "_1"
                                                                                                },
                                                                                                "span": {
                                                                                                  "start": 1407,
                                                                                                  "end": 1411
                                                                                                }
                                                                                              }
                                                                                            }
                                                                                          },
                                                                                          "span": {
                                                                                            "start": 1402,
                                                                                            "end": 1411
                                                                                          }
                                                                                        }
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 1400,
                                                                                        "end": 1412
                                                                                      }
                                                                                    },
                                                                                    "property": {
                                                                                      "kind": {
                                                                                        "Identifier": "a"
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 1414,
                                                                                        "end": 1415
                                                                                      }
                                                                                    }
                                                                                  }
                                                                                },
                                                                                "span": {
                                                                                  "start": 1400,
                                                                                  "end": 1415
                                                                                }
                                                                              },
                                                                              "op": "Assign",
                                                                              "value": {
                                                                                "kind": {
                                                                                  "ClassConstAccess": {
                                                                                    "class": {
                                                                                      "kind": {
                                                                                        "VariableVariable": {
                                                                                          "kind": {
                                                                                            "Binary": {
                                                                                              "left": {
                                                                                                "kind": {
                                                                                                  "Variable": "a"
                                                                                                },
                                                                                                "span": {
                                                                                                  "start": 1420,
                                                                                                  "end": 1422
                                                                                                }
                                                                                              },
                                                                                              "op": "Concat",
                                                                                              "right": {
                                                                                                "kind": {
                                                                                                  "String": "_1"
                                                                                                },
                                                                                                "span": {
                                                                                                  "start": 1425,
                                                                                                  "end": 1429
                                                                                                }
                                                                                              }
                                                                                            }
                                                                                          },
                                                                                          "span": {
                                                                                            "start": 1420,
                                                                                            "end": 1429
                                                                                          }
                                                                                        }
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 1418,
                                                                                        "end": 1430
                                                                                      }
                                                                                    },
                                                                                    "member": {
                                                                                      "kind": {
                                                                                        "Identifier": "C"
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 1432,
                                                                                        "end": 1433
                                                                                      }
                                                                                    }
                                                                                  }
                                                                                },
                                                                                "span": {
                                                                                  "start": 1418,
                                                                                  "end": 1433
                                                                                }
                                                                              }
                                                                            }
                                                                          },
                                                                          "span": {
                                                                            "start": 1400,
                                                                            "end": 1433
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 1400,
                                                                        "end": 1434
                                                                      }
                                                                    },
                                                                    {
                                                                      "kind": {
                                                                        "Expression": {
                                                                          "kind": {
                                                                            "Assign": {
                                                                              "target": {
                                                                                "kind": {
                                                                                  "PropertyAccess": {
                                                                                    "object": {
                                                                                      "kind": {
                                                                                        "Variable": "x"
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 1447,
                                                                                        "end": 1449
                                                                                      }
                                                                                    },
                                                                                    "property": {
                                                                                      "kind": {
                                                                                        "Binary": {
                                                                                          "left": {
                                                                                            "kind": {
                                                                                              "Name": {
                                                                                                "parts": [
                                                                                                  "a"
                                                                                                ],
                                                                                                "kind": "Unqualified",
                                                                                                "span": {
                                                                                                  "start": 1452,
                                                                                                  "end": 1453
                                                                                                }
                                                                                              }
                                                                                            },
                                                                                            "span": {
                                                                                              "start": 1452,
                                                                                              "end": 1453
                                                                                            }
                                                                                          },
                                                                                          "op": "Concat",
                                                                                          "right": {
                                                                                            "kind": {
                                                                                              "String": "_1"
                                                                                            },
                                                                                            "span": {
                                                                                              "start": 1456,
                                                                                              "end": 1460
                                                                                            }
                                                                                          }
                                                                                        }
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 1452,
                                                                                        "end": 1460
                                                                                      }
                                                                                    }
                                                                                  }
                                                                                },
                                                                                "span": {
                                                                                  "start": 1447,
                                                                                  "end": 1460
                                                                                }
                                                                              },
                                                                              "op": "Assign",
                                                                              "value": {
                                                                                "kind": {
                                                                                  "ClassConstAccess": {
                                                                                    "class": {
                                                                                      "kind": {
                                                                                        "Name": {
                                                                                          "parts": [
                                                                                            "C"
                                                                                          ],
                                                                                          "kind": "Unqualified",
                                                                                          "span": {
                                                                                            "start": 1464,
                                                                                            "end": 1465
                                                                                          }
                                                                                        }
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 1464,
                                                                                        "end": 1465
                                                                                      }
                                                                                    },
                                                                                    "member": {
                                                                                      "kind": {
                                                                                        "Identifier": "C"
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 1467,
                                                                                        "end": 1468
                                                                                      }
                                                                                    }
                                                                                  }
                                                                                },
                                                                                "span": {
                                                                                  "start": 1464,
                                                                                  "end": 1468
                                                                                }
                                                                              }
                                                                            }
                                                                          },
                                                                          "span": {
                                                                            "start": 1447,
                                                                            "end": 1468
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 1447,
                                                                        "end": 1469
                                                                      }
                                                                    },
                                                                    {
                                                                      "kind": {
                                                                        "Expression": {
                                                                          "kind": {
                                                                            "Assign": {
                                                                              "target": {
                                                                                "kind": {
                                                                                  "Variable": "x"
                                                                                },
                                                                                "span": {
                                                                                  "start": 1482,
                                                                                  "end": 1484
                                                                                }
                                                                              },
                                                                              "op": "Assign",
                                                                              "value": {
                                                                                "kind": {
                                                                                  "StaticPropertyAccess": {
                                                                                    "class": {
                                                                                      "kind": {
                                                                                        "Name": {
                                                                                          "parts": [
                                                                                            "C"
                                                                                          ],
                                                                                          "kind": "Unqualified",
                                                                                          "span": {
                                                                                            "start": 1487,
                                                                                            "end": 1488
                                                                                          }
                                                                                        }
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 1487,
                                                                                        "end": 1488
                                                                                      }
                                                                                    },
                                                                                    "member": {
                                                                                      "kind": {
                                                                                        "Identifier": "z"
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 1490,
                                                                                        "end": 1492
                                                                                      }
                                                                                    }
                                                                                  }
                                                                                },
                                                                                "span": {
                                                                                  "start": 1487,
                                                                                  "end": 1492
                                                                                }
                                                                              }
                                                                            }
                                                                          },
                                                                          "span": {
                                                                            "start": 1482,
                                                                            "end": 1492
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 1482,
                                                                        "end": 1493
                                                                      }
                                                                    },
                                                                    {
                                                                      "kind": {
                                                                        "Expression": {
                                                                          "kind": {
                                                                            "Assign": {
                                                                              "target": {
                                                                                "kind": {
                                                                                  "Variable": "x"
                                                                                },
                                                                                "span": {
                                                                                  "start": 1506,
                                                                                  "end": 1508
                                                                                }
                                                                              },
                                                                              "op": "Assign",
                                                                              "value": {
                                                                                "kind": {
                                                                                  "StaticPropertyAccess": {
                                                                                    "class": {
                                                                                      "kind": {
                                                                                        "VariableVariable": {
                                                                                          "kind": {
                                                                                            "Binary": {
                                                                                              "left": {
                                                                                                "kind": {
                                                                                                  "Variable": "a"
                                                                                                },
                                                                                                "span": {
                                                                                                  "start": 1513,
                                                                                                  "end": 1515
                                                                                                }
                                                                                              },
                                                                                              "op": "Concat",
                                                                                              "right": {
                                                                                                "kind": {
                                                                                                  "String": "_1"
                                                                                                },
                                                                                                "span": {
                                                                                                  "start": 1518,
                                                                                                  "end": 1522
                                                                                                }
                                                                                              }
                                                                                            }
                                                                                          },
                                                                                          "span": {
                                                                                            "start": 1513,
                                                                                            "end": 1522
                                                                                          }
                                                                                        }
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 1511,
                                                                                        "end": 1523
                                                                                      }
                                                                                    },
                                                                                    "member": {
                                                                                      "kind": {
                                                                                        "Identifier": "z"
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 1525,
                                                                                        "end": 1527
                                                                                      }
                                                                                    }
                                                                                  }
                                                                                },
                                                                                "span": {
                                                                                  "start": 1511,
                                                                                  "end": 1527
                                                                                }
                                                                              }
                                                                            }
                                                                          },
                                                                          "span": {
                                                                            "start": 1506,
                                                                            "end": 1527
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 1506,
                                                                        "end": 1528
                                                                      }
                                                                    },
                                                                    {
                                                                      "kind": {
                                                                        "Expression": {
                                                                          "kind": {
                                                                            "Assign": {
                                                                              "target": {
                                                                                "kind": {
                                                                                  "Variable": "x"
                                                                                },
                                                                                "span": {
                                                                                  "start": 1541,
                                                                                  "end": 1543
                                                                                }
                                                                              },
                                                                              "op": "Assign",
                                                                              "value": {
                                                                                "kind": {
                                                                                  "StaticPropertyAccessDynamic": {
                                                                                    "class": {
                                                                                      "kind": {
                                                                                        "Name": {
                                                                                          "parts": [
                                                                                            "C"
                                                                                          ],
                                                                                          "kind": "Unqualified",
                                                                                          "span": {
                                                                                            "start": 1546,
                                                                                            "end": 1547
                                                                                          }
                                                                                        }
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 1546,
                                                                                        "end": 1547
                                                                                      }
                                                                                    },
                                                                                    "member": {
                                                                                      "kind": {
                                                                                        "VariableVariable": {
                                                                                          "kind": {
                                                                                            "Binary": {
                                                                                              "left": {
                                                                                                "kind": {
                                                                                                  "Variable": "z"
                                                                                                },
                                                                                                "span": {
                                                                                                  "start": 1551,
                                                                                                  "end": 1553
                                                                                                }
                                                                                              },
                                                                                              "op": "Concat",
                                                                                              "right": {
                                                                                                "kind": {
                                                                                                  "String": "_1"
                                                                                                },
                                                                                                "span": {
                                                                                                  "start": 1556,
                                                                                                  "end": 1560
                                                                                                }
                                                                                              }
                                                                                            }
                                                                                          },
                                                                                          "span": {
                                                                                            "start": 1551,
                                                                                            "end": 1560
                                                                                          }
                                                                                        }
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 1549,
                                                                                        "end": 1561
                                                                                      }
                                                                                    }
                                                                                  }
                                                                                },
                                                                                "span": {
                                                                                  "start": 1546,
                                                                                  "end": 1561
                                                                                }
                                                                              }
                                                                            }
                                                                          },
                                                                          "span": {
                                                                            "start": 1541,
                                                                            "end": 1561
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 1541,
                                                                        "end": 1562
                                                                      }
                                                                    },
                                                                    {
                                                                      "kind": {
                                                                        "Expression": {
                                                                          "kind": {
                                                                            "NullsafePropertyAccess": {
                                                                              "object": {
                                                                                "kind": {
                                                                                  "Variable": "x"
                                                                                },
                                                                                "span": {
                                                                                  "start": 1575,
                                                                                  "end": 1577
                                                                                }
                                                                              },
                                                                              "property": {
                                                                                "kind": {
                                                                                  "Identifier": "y"
                                                                                },
                                                                                "span": {
                                                                                  "start": 1580,
                                                                                  "end": 1581
                                                                                }
                                                                              }
                                                                            }
                                                                          },
                                                                          "span": {
                                                                            "start": 1575,
                                                                            "end": 1581
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 1575,
                                                                        "end": 1582
                                                                      }
                                                                    },
                                                                    {
                                                                      "kind": {
                                                                        "Expression": {
                                                                          "kind": {
                                                                            "NullsafeMethodCall": {
                                                                              "object": {
                                                                                "kind": {
                                                                                  "Variable": "x"
                                                                                },
                                                                                "span": {
                                                                                  "start": 1595,
                                                                                  "end": 1597
                                                                                }
                                                                              },
                                                                              "method": {
                                                                                "kind": {
                                                                                  "Identifier": "y"
                                                                                },
                                                                                "span": {
                                                                                  "start": 1600,
                                                                                  "end": 1601
                                                                                }
                                                                              },
                                                                              "args": []
                                                                            }
                                                                          },
                                                                          "span": {
                                                                            "start": 1595,
                                                                            "end": 1603
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 1595,
                                                                        "end": 1604
                                                                      }
                                                                    },
                                                                    {
                                                                      "kind": {
                                                                        "Expression": {
                                                                          "kind": {
                                                                            "FunctionCall": {
                                                                              "name": {
                                                                                "kind": {
                                                                                  "Name": {
                                                                                    "parts": [
                                                                                      "foo"
                                                                                    ],
                                                                                    "kind": "Unqualified",
                                                                                    "span": {
                                                                                      "start": 1617,
                                                                                      "end": 1620
                                                                                    }
                                                                                  }
                                                                                },
                                                                                "span": {
                                                                                  "start": 1617,
                                                                                  "end": 1620
                                                                                }
                                                                              },
                                                                              "args": [
                                                                                {
                                                                                  "name": {
                                                                                    "parts": [
                                                                                      "bar"
                                                                                    ],
                                                                                    "kind": "Unqualified",
                                                                                    "span": {
                                                                                      "start": 1621,
                                                                                      "end": 1624
                                                                                    }
                                                                                  },
                                                                                  "kind": {
                                                                                    "Value": {
                                                                                      "kind": {
                                                                                        "Variable": "x"
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 1626,
                                                                                        "end": 1628
                                                                                      }
                                                                                    }
                                                                                  },
                                                                                  "span": {
                                                                                    "start": 1621,
                                                                                    "end": 1628
                                                                                  }
                                                                                }
                                                                              ]
                                                                            }
                                                                          },
                                                                          "span": {
                                                                            "start": 1617,
                                                                            "end": 1629
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 1617,
                                                                        "end": 1630
                                                                      }
                                                                    }
                                                                  ],
                                                                  "attributes": []
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 713,
                                                                "end": 1640
                                                              }
                                                            }
                                                          ],
                                                          "attributes": []
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 490,
                                                        "end": 1646
                                                      }
                                                    }
                                                  ],
                                                  "attributes": []
                                                }
                                              },
                                              "span": {
                                                "start": 421,
                                                "end": 1648
                                              }
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 416,
                                          "end": 1648
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 415,
                                      "end": 1649
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 410,
                                "end": 1649
                              }
                            }
                          },
                          "span": {
                            "start": 410,
                            "end": 1649
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 403,
                    "end": 1650
                  }
                }
              },
              "span": {
                "start": 403,
                "end": 1651
              }
            }
          ],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "AssertionError"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 1661,
                    "end": 1675
                  }
                }
              ],
              "var": {
                "name": "e",
                "span": {
                  "start": 1676,
                  "end": 1678
                }
              },
              "body": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "MethodCall": {
                            "object": {
                              "kind": {
                                "Variable": "e"
                              },
                              "span": {
                                "start": 1691,
                                "end": 1693
                              }
                            },
                            "method": {
                              "kind": {
                                "Identifier": "getMessage"
                              },
                              "span": {
                                "start": 1695,
                                "end": 1705
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 1691,
                          "end": 1707
                        }
                      },
                      {
                        "kind": {
                          "Name": {
                            "parts": [
                              "PHP_EOL"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1709,
                              "end": 1716
                            }
                          }
                        },
                        "span": {
                          "start": 1709,
                          "end": 1716
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 1686,
                    "end": 1717
                  }
                }
              ],
              "span": {
                "start": 1660,
                "end": 1719
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 397,
        "end": 1719
      }
    },
    {
      "kind": {
        "TryCatch": {
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "assert"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 1727,
                              "end": 1733
                            }
                          }
                        },
                        "span": {
                          "start": 1727,
                          "end": 1733
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "kind": {
                            "Value": {
                              "kind": {
                                "Binary": {
                                  "left": {
                                    "kind": {
                                      "Int": 0
                                    },
                                    "span": {
                                      "start": 1734,
                                      "end": 1735
                                    }
                                  },
                                  "op": "BooleanAnd",
                                  "right": {
                                    "kind": {
                                      "Parenthesized": {
                                        "kind": {
                                          "Assign": {
                                            "target": {
                                              "kind": {
                                                "Variable": "a"
                                              },
                                              "span": {
                                                "start": 1740,
                                                "end": 1742
                                              }
                                            },
                                            "op": "Assign",
                                            "value": {
                                              "kind": {
                                                "Closure": {
                                                  "is_static": false,
                                                  "by_ref": true,
                                                  "params": [
                                                    {
                                                      "name": {
                                                        "name": "a",
                                                        "span": {
                                                          "start": 1763,
                                                          "end": 1765
                                                        }
                                                      },
                                                      "type_hint": {
                                                        "kind": {
                                                          "Named": {
                                                            "parts": [
                                                              "array"
                                                            ],
                                                            "kind": "Unqualified",
                                                            "span": {
                                                              "start": 1756,
                                                              "end": 1761
                                                            }
                                                          }
                                                        },
                                                        "span": {
                                                          "start": 1756,
                                                          "end": 1761
                                                        }
                                                      },
                                                      "default": null,
                                                      "by_ref": true,
                                                      "variadic": false,
                                                      "attributes": [],
                                                      "span": {
                                                        "start": 1756,
                                                        "end": 1765
                                                      }
                                                    },
                                                    {
                                                      "name": {
                                                        "name": "b",
                                                        "span": {
                                                          "start": 1769,
                                                          "end": 1771
                                                        }
                                                      },
                                                      "type_hint": {
                                                        "kind": {
                                                          "Named": {
                                                            "parts": [
                                                              "X"
                                                            ],
                                                            "kind": "Unqualified",
                                                            "span": {
                                                              "start": 1767,
                                                              "end": 1768
                                                            }
                                                          }
                                                        },
                                                        "span": {
                                                          "start": 1767,
                                                          "end": 1768
                                                        }
                                                      },
                                                      "default": {
                                                        "kind": "Null",
                                                        "span": {
                                                          "start": 1774,
                                                          "end": 1778
                                                        }
                                                      },
                                                      "by_ref": false,
                                                      "variadic": false,
                                                      "attributes": [],
                                                      "span": {
                                                        "start": 1767,
                                                        "end": 1778
                                                      }
                                                    },
                                                    {
                                                      "name": {
                                                        "name": "c",
                                                        "span": {
                                                          "start": 1790,
                                                          "end": 1792
                                                        }
                                                      },
                                                      "type_hint": {
                                                        "kind": {
                                                          "Union": [
                                                            {
                                                              "kind": {
                                                                "Named": {
                                                                  "parts": [
                                                                    "int"
                                                                  ],
                                                                  "kind": "Unqualified",
                                                                  "span": {
                                                                    "start": 1780,
                                                                    "end": 1783
                                                                  }
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 1780,
                                                                "end": 1783
                                                              }
                                                            },
                                                            {
                                                              "kind": {
                                                                "Named": {
                                                                  "parts": [
                                                                    "float"
                                                                  ],
                                                                  "kind": "Unqualified",
                                                                  "span": {
                                                                    "start": 1784,
                                                                    "end": 1789
                                                                  }
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 1784,
                                                                "end": 1789
                                                              }
                                                            }
                                                          ]
                                                        },
                                                        "span": {
                                                          "start": 1780,
                                                          "end": 1789
                                                        }
                                                      },
                                                      "default": null,
                                                      "by_ref": false,
                                                      "variadic": false,
                                                      "attributes": [],
                                                      "span": {
                                                        "start": 1780,
                                                        "end": 1792
                                                      }
                                                    }
                                                  ],
                                                  "use_vars": [
                                                    {
                                                      "name": {
                                                        "name": "c",
                                                        "span": {
                                                          "start": 1799,
                                                          "end": 1801
                                                        }
                                                      },
                                                      "by_ref": false,
                                                      "span": {
                                                        "start": 1799,
                                                        "end": 1801
                                                      }
                                                    },
                                                    {
                                                      "name": {
                                                        "name": "d",
                                                        "span": {
                                                          "start": 1803,
                                                          "end": 1805
                                                        }
                                                      },
                                                      "by_ref": true,
                                                      "span": {
                                                        "start": 1802,
                                                        "end": 1805
                                                      }
                                                    }
                                                  ],
                                                  "return_type": {
                                                    "kind": {
                                                      "Named": {
                                                        "parts": [
                                                          "X"
                                                        ],
                                                        "kind": "Unqualified",
                                                        "span": {
                                                          "start": 1809,
                                                          "end": 1810
                                                        }
                                                      }
                                                    },
                                                    "span": {
                                                      "start": 1809,
                                                      "end": 1810
                                                    }
                                                  },
                                                  "body": [
                                                    {
                                                      "kind": {
                                                        "Class": {
                                                          "name": {
                                                            "name": "A",
                                                            "span": {
                                                              "start": 1829,
                                                              "end": 1830
                                                            }
                                                          },
                                                          "modifiers": {
                                                            "is_abstract": false,
                                                            "is_final": true,
                                                            "is_readonly": false
                                                          },
                                                          "extends": null,
                                                          "implements": [],
                                                          "members": [
                                                            {
                                                              "kind": {
                                                                "Method": {
                                                                  "name": {
                                                                    "name": "f2",
                                                                    "span": {
                                                                      "start": 1866,
                                                                      "end": 1868
                                                                    }
                                                                  },
                                                                  "modifiers": {
                                                                    "visibility": "Protected",
                                                                    "is_final": true
                                                                  },
                                                                  "by_ref": false,
                                                                  "params": [],
                                                                  "return_type": null,
                                                                  "body": [
                                                                    {
                                                                      "kind": {
                                                                        "If": {
                                                                          "condition": {
                                                                            "kind": {
                                                                              "UnaryPrefix": {
                                                                                "op": "BooleanNot",
                                                                                "operand": {
                                                                                  "kind": {
                                                                                    "Variable": "x"
                                                                                  },
                                                                                  "span": {
                                                                                    "start": 1890,
                                                                                    "end": 1892
                                                                                  }
                                                                                }
                                                                              }
                                                                            },
                                                                            "span": {
                                                                              "start": 1889,
                                                                              "end": 1892
                                                                            }
                                                                          },
                                                                          "then_branch": {
                                                                            "kind": {
                                                                              "Block": [
                                                                                {
                                                                                  "kind": {
                                                                                    "Return": {
                                                                                      "kind": {
                                                                                        "Int": 0
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 1919,
                                                                                        "end": 1920
                                                                                      }
                                                                                    }
                                                                                  },
                                                                                  "span": {
                                                                                    "start": 1912,
                                                                                    "end": 1921
                                                                                  }
                                                                                }
                                                                              ]
                                                                            },
                                                                            "span": {
                                                                              "start": 1894,
                                                                              "end": 1935
                                                                            }
                                                                          },
                                                                          "elseif_branches": [],
                                                                          "else_branch": null
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 1885,
                                                                        "end": 1935
                                                                      }
                                                                    },
                                                                    {
                                                                      "kind": {
                                                                        "If": {
                                                                          "condition": {
                                                                            "kind": {
                                                                              "Binary": {
                                                                                "left": {
                                                                                  "kind": {
                                                                                    "Variable": "x"
                                                                                  },
                                                                                  "span": {
                                                                                    "start": 1952,
                                                                                    "end": 1954
                                                                                  }
                                                                                },
                                                                                "op": "Equal",
                                                                                "right": {
                                                                                  "kind": {
                                                                                    "Int": 1
                                                                                  },
                                                                                  "span": {
                                                                                    "start": 1958,
                                                                                    "end": 1959
                                                                                  }
                                                                                }
                                                                              }
                                                                            },
                                                                            "span": {
                                                                              "start": 1952,
                                                                              "end": 1959
                                                                            }
                                                                          },
                                                                          "then_branch": {
                                                                            "kind": {
                                                                              "Block": [
                                                                                {
                                                                                  "kind": {
                                                                                    "Return": {
                                                                                      "kind": {
                                                                                        "Int": 1
                                                                                      },
                                                                                      "span": {
                                                                                        "start": 1986,
                                                                                        "end": 1987
                                                                                      }
                                                                                    }
                                                                                  },
                                                                                  "span": {
                                                                                    "start": 1979,
                                                                                    "end": 1988
                                                                                  }
                                                                                }
                                                                              ]
                                                                            },
                                                                            "span": {
                                                                              "start": 1961,
                                                                              "end": 2002
                                                                            }
                                                                          },
                                                                          "elseif_branches": [],
                                                                          "else_branch": {
                                                                            "kind": {
                                                                              "If": {
                                                                                "condition": {
                                                                                  "kind": {
                                                                                    "Binary": {
                                                                                      "left": {
                                                                                        "kind": {
                                                                                          "Variable": "x"
                                                                                        },
                                                                                        "span": {
                                                                                          "start": 2012,
                                                                                          "end": 2014
                                                                                        }
                                                                                      },
                                                                                      "op": "Equal",
                                                                                      "right": {
                                                                                        "kind": {
                                                                                          "Int": 2
                                                                                        },
                                                                                        "span": {
                                                                                          "start": 2018,
                                                                                          "end": 2019
                                                                                        }
                                                                                      }
                                                                                    }
                                                                                  },
                                                                                  "span": {
                                                                                    "start": 2012,
                                                                                    "end": 2019
                                                                                  }
                                                                                },
                                                                                "then_branch": {
                                                                                  "kind": {
                                                                                    "Block": [
                                                                                      {
                                                                                        "kind": {
                                                                                          "Return": {
                                                                                            "kind": {
                                                                                              "Int": 2
                                                                                            },
                                                                                            "span": {
                                                                                              "start": 2046,
                                                                                              "end": 2047
                                                                                            }
                                                                                          }
                                                                                        },
                                                                                        "span": {
                                                                                          "start": 2039,
                                                                                          "end": 2048
                                                                                        }
                                                                                      }
                                                                                    ]
                                                                                  },
                                                                                  "span": {
                                                                                    "start": 2021,
                                                                                    "end": 2062
                                                                                  }
                                                                                },
                                                                                "elseif_branches": [],
                                                                                "else_branch": {
                                                                                  "kind": {
                                                                                    "If": {
                                                                                      "condition": {
                                                                                        "kind": {
                                                                                          "Binary": {
                                                                                            "left": {
                                                                                              "kind": {
                                                                                                "Variable": "x"
                                                                                              },
                                                                                              "span": {
                                                                                                "start": 2072,
                                                                                                "end": 2074
                                                                                              }
                                                                                            },
                                                                                            "op": "Equal",
                                                                                            "right": {
                                                                                              "kind": {
                                                                                                "Int": 3
                                                                                              },
                                                                                              "span": {
                                                                                                "start": 2078,
                                                                                                "end": 2079
                                                                                              }
                                                                                            }
                                                                                          }
                                                                                        },
                                                                                        "span": {
                                                                                          "start": 2072,
                                                                                          "end": 2079
                                                                                        }
                                                                                      },
                                                                                      "then_branch": {
                                                                                        "kind": {
                                                                                          "Block": [
                                                                                            {
                                                                                              "kind": {
                                                                                                "Return": {
                                                                                                  "kind": {
                                                                                                    "Int": 3
                                                                                                  },
                                                                                                  "span": {
                                                                                                    "start": 2106,
                                                                                                    "end": 2107
                                                                                                  }
                                                                                                }
                                                                                              },
                                                                                              "span": {
                                                                                                "start": 2099,
                                                                                                "end": 2108
                                                                                              }
                                                                                            }
                                                                                          ]
                                                                                        },
                                                                                        "span": {
                                                                                          "start": 2081,
                                                                                          "end": 2122
                                                                                        }
                                                                                      },
                                                                                      "elseif_branches": [],
                                                                                      "else_branch": {
                                                                                        "kind": {
                                                                                          "Block": [
                                                                                            {
                                                                                              "kind": {
                                                                                                "If": {
                                                                                                  "condition": {
                                                                                                    "kind": {
                                                                                                      "Binary": {
                                                                                                        "left": {
                                                                                                          "kind": {
                                                                                                            "Variable": "x"
                                                                                                          },
                                                                                                          "span": {
                                                                                                            "start": 2150,
                                                                                                            "end": 2152
                                                                                                          }
                                                                                                        },
                                                                                                        "op": "Equal",
                                                                                                        "right": {
                                                                                                          "kind": {
                                                                                                            "Int": 9
                                                                                                          },
                                                                                                          "span": {
                                                                                                            "start": 2156,
                                                                                                            "end": 2157
                                                                                                          }
                                                                                                        }
                                                                                                      }
                                                                                                    },
                                                                                                    "span": {
                                                                                                      "start": 2150,
                                                                                                      "end": 2157
                                                                                                    }
                                                                                                  },
                                                                                                  "then_branch": {
                                                                                                    "kind": {
                                                                                                      "Block": [
                                                                                                        {
                                                                                                          "kind": {
                                                                                                            "Return": {
                                                                                                              "kind": {
                                                                                                                "Int": 9
                                                                                                              },
                                                                                                              "span": {
                                                                                                                "start": 2188,
                                                                                                                "end": 2189
                                                                                                              }
                                                                                                            }
                                                                                                          },
                                                                                                          "span": {
                                                                                                            "start": 2181,
                                                                                                            "end": 2190
                                                                                                          }
                                                                                                        }
                                                                                                      ]
                                                                                                    },
                                                                                                    "span": {
                                                                                                      "start": 2159,
                                                                                                      "end": 2208
                                                                                                    }
                                                                                                  },
                                                                                                  "elseif_branches": [],
                                                                                                  "else_branch": null
                                                                                                }
                                                                                              },
                                                                                              "span": {
                                                                                                "start": 2146,
                                                                                                "end": 2208
                                                                                              }
                                                                                            },
                                                                                            {
                                                                                              "kind": {
                                                                                                "Label": {
                                                                                                  "name": "L0",
                                                                                                  "span": {
                                                                                                    "start": 2209,
                                                                                                    "end": 2211
                                                                                                  }
                                                                                                }
                                                                                              },
                                                                                              "span": {
                                                                                                "start": 2209,
                                                                                                "end": 2212
                                                                                              }
                                                                                            },
                                                                                            {
                                                                                              "kind": {
                                                                                                "DoWhile": {
                                                                                                  "body": {
                                                                                                    "kind": {
                                                                                                      "Block": [
                                                                                                        {
                                                                                                          "kind": {
                                                                                                            "Switch": {
                                                                                                              "expr": {
                                                                                                                "kind": {
                                                                                                                  "Variable": "x"
                                                                                                                },
                                                                                                                "span": {
                                                                                                                  "start": 2262,
                                                                                                                  "end": 2264
                                                                                                                }
                                                                                                              },
                                                                                                              "cases": [
                                                                                                                {
                                                                                                                  "value": {
                                                                                                                    "kind": {
                                                                                                                      "Int": 4
                                                                                                                    },
                                                                                                                    "span": {
                                                                                                                      "start": 2297,
                                                                                                                      "end": 2298
                                                                                                                    }
                                                                                                                  },
                                                                                                                  "body": [
                                                                                                                    {
                                                                                                                      "kind": {
                                                                                                                        "Break": null
                                                                                                                      },
                                                                                                                      "span": {
                                                                                                                        "start": 2300,
                                                                                                                        "end": 2306
                                                                                                                      }
                                                                                                                    }
                                                                                                                  ],
                                                                                                                  "span": {
                                                                                                                    "start": 2292,
                                                                                                                    "end": 2306
                                                                                                                  }
                                                                                                                },
                                                                                                                {
                                                                                                                  "value": {
                                                                                                                    "kind": {
                                                                                                                      "Int": 5
                                                                                                                    },
                                                                                                                    "span": {
                                                                                                                      "start": 2336,
                                                                                                                      "end": 2337
                                                                                                                    }
                                                                                                                  },
                                                                                                                  "body": [
                                                                                                                    {
                                                                                                                      "kind": {
                                                                                                                        "Continue": null
                                                                                                                      },
                                                                                                                      "span": {
                                                                                                                        "start": 2339,
                                                                                                                        "end": 2348
                                                                                                                      }
                                                                                                                    }
                                                                                                                  ],
                                                                                                                  "span": {
                                                                                                                    "start": 2331,
                                                                                                                    "end": 2348
                                                                                                                  }
                                                                                                                },
                                                                                                                {
                                                                                                                  "value": {
                                                                                                                    "kind": {
                                                                                                                      "Int": 6
                                                                                                                    },
                                                                                                                    "span": {
                                                                                                                      "start": 2378,
                                                                                                                      "end": 2379
                                                                                                                    }
                                                                                                                  },
                                                                                                                  "body": [
                                                                                                                    {
                                                                                                                      "kind": {
                                                                                                                        "Break": {
                                                                                                                          "kind": {
                                                                                                                            "Int": 2
                                                                                                                          },
                                                                                                                          "span": {
                                                                                                                            "start": 2387,
                                                                                                                            "end": 2388
                                                                                                                          }
                                                                                                                        }
                                                                                                                      },
                                                                                                                      "span": {
                                                                                                                        "start": 2381,
                                                                                                                        "end": 2389
                                                                                                                      }
                                                                                                                    }
                                                                                                                  ],
                                                                                                                  "span": {
                                                                                                                    "start": 2373,
                                                                                                                    "end": 2389
                                                                                                                  }
                                                                                                                },
                                                                                                                {
                                                                                                                  "value": {
                                                                                                                    "kind": {
                                                                                                                      "Int": 7
                                                                                                                    },
                                                                                                                    "span": {
                                                                                                                      "start": 2419,
                                                                                                                      "end": 2420
                                                                                                                    }
                                                                                                                  },
                                                                                                                  "body": [
                                                                                                                    {
                                                                                                                      "kind": {
                                                                                                                        "Continue": {
                                                                                                                          "kind": {
                                                                                                                            "Int": 2
                                                                                                                          },
                                                                                                                          "span": {
                                                                                                                            "start": 2431,
                                                                                                                            "end": 2432
                                                                                                                          }
                                                                                                                        }
                                                                                                                      },
                                                                                                                      "span": {
                                                                                                                        "start": 2422,
                                                                                                                        "end": 2433
                                                                                                                      }
                                                                                                                    }
                                                                                                                  ],
                                                                                                                  "span": {
                                                                                                                    "start": 2414,
                                                                                                                    "end": 2433
                                                                                                                  }
                                                                                                                },
                                                                                                                {
                                                                                                                  "value": {
                                                                                                                    "kind": {
                                                                                                                      "Int": 8
                                                                                                                    },
                                                                                                                    "span": {
                                                                                                                      "start": 2463,
                                                                                                                      "end": 2464
                                                                                                                    }
                                                                                                                  },
                                                                                                                  "body": [
                                                                                                                    {
                                                                                                                      "kind": {
                                                                                                                        "Goto": {
                                                                                                                          "name": "L0",
                                                                                                                          "span": {
                                                                                                                            "start": 2471,
                                                                                                                            "end": 2473
                                                                                                                          }
                                                                                                                        }
                                                                                                                      },
                                                                                                                      "span": {
                                                                                                                        "start": 2466,
                                                                                                                        "end": 2474
                                                                                                                      }
                                                                                                                    }
                                                                                                                  ],
                                                                                                                  "span": {
                                                                                                                    "start": 2458,
                                                                                                                    "end": 2474
                                                                                                                  }
                                                                                                                },
                                                                                                                {
                                                                                                                  "value": null,
                                                                                                                  "body": [
                                                                                                                    {
                                                                                                                      "kind": {
                                                                                                                        "Return": null
                                                                                                                      },
                                                                                                                      "span": {
                                                                                                                        "start": 2508,
                                                                                                                        "end": 2515
                                                                                                                      }
                                                                                                                    }
                                                                                                                  ],
                                                                                                                  "span": {
                                                                                                                    "start": 2499,
                                                                                                                    "end": 2515
                                                                                                                  }
                                                                                                                }
                                                                                                              ]
                                                                                                            }
                                                                                                          },
                                                                                                          "span": {
                                                                                                            "start": 2254,
                                                                                                            "end": 2537
                                                                                                          }
                                                                                                        }
                                                                                                      ]
                                                                                                    },
                                                                                                    "span": {
                                                                                                      "start": 2232,
                                                                                                      "end": 2555
                                                                                                    }
                                                                                                  },
                                                                                                  "condition": {
                                                                                                    "kind": {
                                                                                                      "Int": 0
                                                                                                    },
                                                                                                    "span": {
                                                                                                      "start": 2563,
                                                                                                      "end": 2564
                                                                                                    }
                                                                                                  }
                                                                                                }
                                                                                              },
                                                                                              "span": {
                                                                                                "start": 2229,
                                                                                                "end": 2566
                                                                                              }
                                                                                            }
                                                                                          ]
                                                                                        },
                                                                                        "span": {
                                                                                          "start": 2128,
                                                                                          "end": 2580
                                                                                        }
                                                                                      }
                                                                                    }
                                                                                  },
                                                                                  "span": {
                                                                                    "start": 2068,
                                                                                    "end": 2580
                                                                                  }
                                                                                }
                                                                              }
                                                                            },
                                                                            "span": {
                                                                              "start": 2008,
                                                                              "end": 2580
                                                                            }
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 1948,
                                                                        "end": 2580
                                                                      }
                                                                    }
                                                                  ],
                                                                  "attributes": []
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 1841,
                                                                "end": 2590
                                                              }
                                                            }
                                                          ],
                                                          "attributes": []
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 1823,
                                                        "end": 2596
                                                      }
                                                    }
                                                  ],
                                                  "attributes": []
                                                }
                                              },
                                              "span": {
                                                "start": 1745,
                                                "end": 2598
                                              }
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 1740,
                                          "end": 2598
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 1739,
                                      "end": 2599
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 1734,
                                "end": 2599
                              }
                            }
                          },
                          "span": {
                            "start": 1734,
                            "end": 2599
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 1727,
                    "end": 2600
                  }
                }
              },
              "span": {
                "start": 1727,
                "end": 2601
              }
            }
          ],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "AssertionError"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 2611,
                    "end": 2625
                  }
                }
              ],
              "var": {
                "name": "e",
                "span": {
                  "start": 2626,
                  "end": 2628
                }
              },
              "body": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "MethodCall": {
                            "object": {
                              "kind": {
                                "Variable": "e"
                              },
                              "span": {
                                "start": 2641,
                                "end": 2643
                              }
                            },
                            "method": {
                              "kind": {
                                "Identifier": "getMessage"
                              },
                              "span": {
                                "start": 2645,
                                "end": 2655
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 2641,
                          "end": 2657
                        }
                      },
                      {
                        "kind": {
                          "Name": {
                            "parts": [
                              "PHP_EOL"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 2659,
                              "end": 2666
                            }
                          }
                        },
                        "span": {
                          "start": 2659,
                          "end": 2666
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 2636,
                    "end": 2667
                  }
                }
              ],
              "span": {
                "start": 2610,
                "end": 2669
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 1721,
        "end": 2669
      }
    },
    {
      "kind": {
        "TryCatch": {
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "assert"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 2677,
                              "end": 2683
                            }
                          }
                        },
                        "span": {
                          "start": 2677,
                          "end": 2683
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "kind": {
                            "Value": {
                              "kind": {
                                "Binary": {
                                  "left": {
                                    "kind": {
                                      "Int": 0
                                    },
                                    "span": {
                                      "start": 2684,
                                      "end": 2685
                                    }
                                  },
                                  "op": "BooleanAnd",
                                  "right": {
                                    "kind": {
                                      "Parenthesized": {
                                        "kind": {
                                          "Assign": {
                                            "target": {
                                              "kind": {
                                                "Variable": "a"
                                              },
                                              "span": {
                                                "start": 2690,
                                                "end": 2692
                                              }
                                            },
                                            "op": "Assign",
                                            "value": {
                                              "kind": {
                                                "Closure": {
                                                  "is_static": false,
                                                  "by_ref": true,
                                                  "params": [
                                                    {
                                                      "name": {
                                                        "name": "a",
                                                        "span": {
                                                          "start": 2714,
                                                          "end": 2716
                                                        }
                                                      },
                                                      "type_hint": {
                                                        "kind": {
                                                          "Nullable": {
                                                            "kind": {
                                                              "Named": {
                                                                "parts": [
                                                                  "array"
                                                                ],
                                                                "kind": "Unqualified",
                                                                "span": {
                                                                  "start": 2707,
                                                                  "end": 2712
                                                                }
                                                              }
                                                            },
                                                            "span": {
                                                              "start": 2707,
                                                              "end": 2712
                                                            }
                                                          }
                                                        },
                                                        "span": {
                                                          "start": 2706,
                                                          "end": 2712
                                                        }
                                                      },
                                                      "default": null,
                                                      "by_ref": true,
                                                      "variadic": false,
                                                      "attributes": [],
                                                      "span": {
                                                        "start": 2706,
                                                        "end": 2716
                                                      }
                                                    },
                                                    {
                                                      "name": {
                                                        "name": "b",
                                                        "span": {
                                                          "start": 2720,
                                                          "end": 2722
                                                        }
                                                      },
                                                      "type_hint": {
                                                        "kind": {
                                                          "Named": {
                                                            "parts": [
                                                              "X"
                                                            ],
                                                            "kind": "Unqualified",
                                                            "span": {
                                                              "start": 2718,
                                                              "end": 2719
                                                            }
                                                          }
                                                        },
                                                        "span": {
                                                          "start": 2718,
                                                          "end": 2719
                                                        }
                                                      },
                                                      "default": {
                                                        "kind": "Null",
                                                        "span": {
                                                          "start": 2725,
                                                          "end": 2729
                                                        }
                                                      },
                                                      "by_ref": false,
                                                      "variadic": false,
                                                      "attributes": [],
                                                      "span": {
                                                        "start": 2718,
                                                        "end": 2729
                                                      }
                                                    }
                                                  ],
                                                  "use_vars": [
                                                    {
                                                      "name": {
                                                        "name": "c",
                                                        "span": {
                                                          "start": 2736,
                                                          "end": 2738
                                                        }
                                                      },
                                                      "by_ref": false,
                                                      "span": {
                                                        "start": 2736,
                                                        "end": 2738
                                                      }
                                                    },
                                                    {
                                                      "name": {
                                                        "name": "d",
                                                        "span": {
                                                          "start": 2740,
                                                          "end": 2742
                                                        }
                                                      },
                                                      "by_ref": true,
                                                      "span": {
                                                        "start": 2739,
                                                        "end": 2742
                                                      }
                                                    }
                                                  ],
                                                  "return_type": {
                                                    "kind": {
                                                      "Named": {
                                                        "parts": [
                                                          "X"
                                                        ],
                                                        "kind": "Unqualified",
                                                        "span": {
                                                          "start": 2746,
                                                          "end": 2747
                                                        }
                                                      }
                                                    },
                                                    "span": {
                                                      "start": 2746,
                                                      "end": 2747
                                                    }
                                                  },
                                                  "body": [
                                                    {
                                                      "kind": {
                                                        "Class": {
                                                          "name": {
                                                            "name": "A",
                                                            "span": {
                                                              "start": 2760,
                                                              "end": 2761
                                                            }
                                                          },
                                                          "modifiers": {
                                                            "is_abstract": false,
                                                            "is_final": false,
                                                            "is_readonly": false
                                                          },
                                                          "extends": null,
                                                          "implements": [],
                                                          "members": [
                                                            {
                                                              "kind": {
                                                                "TraitUse": {
                                                                  "traits": [
                                                                    {
                                                                      "parts": [
                                                                        "T1"
                                                                      ],
                                                                      "kind": "Unqualified",
                                                                      "span": {
                                                                        "start": 2776,
                                                                        "end": 2778
                                                                      }
                                                                    },
                                                                    {
                                                                      "parts": [
                                                                        "T2"
                                                                      ],
                                                                      "kind": "Unqualified",
                                                                      "span": {
                                                                        "start": 2780,
                                                                        "end": 2782
                                                                      }
                                                                    }
                                                                  ],
                                                                  "adaptations": [
                                                                    {
                                                                      "kind": {
                                                                        "Precedence": {
                                                                          "trait_name": {
                                                                            "parts": [
                                                                              "T1"
                                                                            ],
                                                                            "kind": "Unqualified",
                                                                            "span": {
                                                                              "start": 2797,
                                                                              "end": 2799
                                                                            }
                                                                          },
                                                                          "method": {
                                                                            "parts": [
                                                                              "foo"
                                                                            ],
                                                                            "kind": "Unqualified",
                                                                            "span": {
                                                                              "start": 2801,
                                                                              "end": 2804
                                                                            }
                                                                          },
                                                                          "insteadof": [
                                                                            {
                                                                              "parts": [
                                                                                "foo"
                                                                              ],
                                                                              "kind": "Unqualified",
                                                                              "span": {
                                                                                "start": 2815,
                                                                                "end": 2818
                                                                              }
                                                                            }
                                                                          ]
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 2797,
                                                                        "end": 2819
                                                                      }
                                                                    },
                                                                    {
                                                                      "kind": {
                                                                        "Alias": {
                                                                          "trait_name": {
                                                                            "parts": [
                                                                              "T2"
                                                                            ],
                                                                            "kind": "Unqualified",
                                                                            "span": {
                                                                              "start": 2832,
                                                                              "end": 2834
                                                                            }
                                                                          },
                                                                          "method": {
                                                                            "parts": [
                                                                              "foo"
                                                                            ],
                                                                            "kind": "Unqualified",
                                                                            "span": {
                                                                              "start": 2836,
                                                                              "end": 2839
                                                                            }
                                                                          },
                                                                          "new_modifier": null,
                                                                          "new_name": {
                                                                            "parts": [
                                                                              "bar"
                                                                            ],
                                                                            "kind": "Unqualified",
                                                                            "span": {
                                                                              "start": 2843,
                                                                              "end": 2846
                                                                            }
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 2832,
                                                                        "end": 2847
                                                                      }
                                                                    },
                                                                    {
                                                                      "kind": {
                                                                        "Alias": {
                                                                          "trait_name": null,
                                                                          "method": {
                                                                            "parts": [
                                                                              "baz"
                                                                            ],
                                                                            "kind": "Unqualified",
                                                                            "span": {
                                                                              "start": 2860,
                                                                              "end": 2863
                                                                            }
                                                                          },
                                                                          "new_modifier": "Public",
                                                                          "new_name": null
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 2860,
                                                                        "end": 2874
                                                                      }
                                                                    },
                                                                    {
                                                                      "kind": {
                                                                        "Alias": {
                                                                          "trait_name": null,
                                                                          "method": {
                                                                            "parts": [
                                                                              "ops"
                                                                            ],
                                                                            "kind": "Unqualified",
                                                                            "span": {
                                                                              "start": 2887,
                                                                              "end": 2890
                                                                            }
                                                                          },
                                                                          "new_modifier": "Protected",
                                                                          "new_name": {
                                                                            "parts": [
                                                                              "x"
                                                                            ],
                                                                            "kind": "Unqualified",
                                                                            "span": {
                                                                              "start": 2904,
                                                                              "end": 2905
                                                                            }
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 2887,
                                                                        "end": 2906
                                                                      }
                                                                    }
                                                                  ]
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 2772,
                                                                "end": 2916
                                                              }
                                                            },
                                                            {
                                                              "kind": {
                                                                "TraitUse": {
                                                                  "traits": [
                                                                    {
                                                                      "parts": [
                                                                        "T3"
                                                                      ],
                                                                      "kind": "Unqualified",
                                                                      "span": {
                                                                        "start": 2929,
                                                                        "end": 2931
                                                                      }
                                                                    }
                                                                  ],
                                                                  "adaptations": []
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 2925,
                                                                "end": 2932
                                                              }
                                                            }
                                                          ],
                                                          "attributes": []
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 2754,
                                                        "end": 2938
                                                      }
                                                    }
                                                  ],
                                                  "attributes": []
                                                }
                                              },
                                              "span": {
                                                "start": 2695,
                                                "end": 2940
                                              }
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 2690,
                                          "end": 2940
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 2689,
                                      "end": 2941
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 2684,
                                "end": 2941
                              }
                            }
                          },
                          "span": {
                            "start": 2684,
                            "end": 2941
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 2677,
                    "end": 2942
                  }
                }
              },
              "span": {
                "start": 2677,
                "end": 2943
              }
            }
          ],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "AssertionError"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 2953,
                    "end": 2967
                  }
                }
              ],
              "var": {
                "name": "e",
                "span": {
                  "start": 2968,
                  "end": 2970
                }
              },
              "body": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "MethodCall": {
                            "object": {
                              "kind": {
                                "Variable": "e"
                              },
                              "span": {
                                "start": 2983,
                                "end": 2985
                              }
                            },
                            "method": {
                              "kind": {
                                "Identifier": "getMessage"
                              },
                              "span": {
                                "start": 2987,
                                "end": 2997
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 2983,
                          "end": 2999
                        }
                      },
                      {
                        "kind": {
                          "Name": {
                            "parts": [
                              "PHP_EOL"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 3001,
                              "end": 3008
                            }
                          }
                        },
                        "span": {
                          "start": 3001,
                          "end": 3008
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 2978,
                    "end": 3009
                  }
                }
              ],
              "span": {
                "start": 2952,
                "end": 3011
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 2671,
        "end": 3011
      }
    },
    {
      "kind": {
        "TryCatch": {
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "assert"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 3019,
                              "end": 3025
                            }
                          }
                        },
                        "span": {
                          "start": 3019,
                          "end": 3025
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "kind": {
                            "Value": {
                              "kind": {
                                "Binary": {
                                  "left": {
                                    "kind": {
                                      "Int": 0
                                    },
                                    "span": {
                                      "start": 3026,
                                      "end": 3027
                                    }
                                  },
                                  "op": "BooleanAnd",
                                  "right": {
                                    "kind": {
                                      "Parenthesized": {
                                        "kind": {
                                          "Assign": {
                                            "target": {
                                              "kind": {
                                                "Variable": "a"
                                              },
                                              "span": {
                                                "start": 3032,
                                                "end": 3034
                                              }
                                            },
                                            "op": "Assign",
                                            "value": {
                                              "kind": {
                                                "Closure": {
                                                  "is_static": false,
                                                  "by_ref": true,
                                                  "params": [
                                                    {
                                                      "name": {
                                                        "name": "a",
                                                        "span": {
                                                          "start": 3058,
                                                          "end": 3060
                                                        }
                                                      },
                                                      "type_hint": {
                                                        "kind": {
                                                          "Named": {
                                                            "parts": [
                                                              "array"
                                                            ],
                                                            "kind": "Unqualified",
                                                            "span": {
                                                              "start": 3048,
                                                              "end": 3053
                                                            }
                                                          }
                                                        },
                                                        "span": {
                                                          "start": 3048,
                                                          "end": 3053
                                                        }
                                                      },
                                                      "default": null,
                                                      "by_ref": true,
                                                      "variadic": true,
                                                      "attributes": [],
                                                      "span": {
                                                        "start": 3048,
                                                        "end": 3060
                                                      }
                                                    }
                                                  ],
                                                  "use_vars": [],
                                                  "return_type": null,
                                                  "body": [
                                                    {
                                                      "kind": {
                                                        "Declare": {
                                                          "directives": [
                                                            [
                                                              "A",
                                                              {
                                                                "kind": {
                                                                  "Int": 1
                                                                },
                                                                "span": {
                                                                  "start": 3078,
                                                                  "end": 3079
                                                                }
                                                              }
                                                            ],
                                                            [
                                                              "B",
                                                              {
                                                                "kind": {
                                                                  "Int": 2
                                                                },
                                                                "span": {
                                                                  "start": 3082,
                                                                  "end": 3083
                                                                }
                                                              }
                                                            ]
                                                          ],
                                                          "body": null
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 3068,
                                                        "end": 3085
                                                      }
                                                    },
                                                    {
                                                      "kind": {
                                                        "TryCatch": {
                                                          "body": [
                                                            {
                                                              "kind": {
                                                                "Expression": {
                                                                  "kind": {
                                                                    "UnaryPostfix": {
                                                                      "operand": {
                                                                        "kind": {
                                                                          "Variable": "i"
                                                                        },
                                                                        "span": {
                                                                          "start": 3104,
                                                                          "end": 3106
                                                                        }
                                                                      },
                                                                      "op": "PostIncrement"
                                                                    }
                                                                  },
                                                                  "span": {
                                                                    "start": 3104,
                                                                    "end": 3108
                                                                  }
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 3104,
                                                                "end": 3109
                                                              }
                                                            }
                                                          ],
                                                          "catches": [
                                                            {
                                                              "types": [
                                                                {
                                                                  "parts": [
                                                                    "MyException"
                                                                  ],
                                                                  "kind": "Unqualified",
                                                                  "span": {
                                                                    "start": 3123,
                                                                    "end": 3134
                                                                  }
                                                                }
                                                              ],
                                                              "var": {
                                                                "name": "e",
                                                                "span": {
                                                                  "start": 3135,
                                                                  "end": 3137
                                                                }
                                                              },
                                                              "body": [
                                                                {
                                                                  "kind": {
                                                                    "Echo": [
                                                                      {
                                                                        "kind": {
                                                                          "Int": 1
                                                                        },
                                                                        "span": {
                                                                          "start": 3154,
                                                                          "end": 3155
                                                                        }
                                                                      }
                                                                    ]
                                                                  },
                                                                  "span": {
                                                                    "start": 3149,
                                                                    "end": 3156
                                                                  }
                                                                }
                                                              ],
                                                              "span": {
                                                                "start": 3122,
                                                                "end": 3162
                                                              }
                                                            },
                                                            {
                                                              "types": [
                                                                {
                                                                  "parts": [
                                                                    "Exception"
                                                                  ],
                                                                  "kind": "Unqualified",
                                                                  "span": {
                                                                    "start": 3170,
                                                                    "end": 3179
                                                                  }
                                                                }
                                                              ],
                                                              "var": {
                                                                "name": "e",
                                                                "span": {
                                                                  "start": 3180,
                                                                  "end": 3182
                                                                }
                                                              },
                                                              "body": [
                                                                {
                                                                  "kind": {
                                                                    "Echo": [
                                                                      {
                                                                        "kind": {
                                                                          "Int": 2
                                                                        },
                                                                        "span": {
                                                                          "start": 3199,
                                                                          "end": 3200
                                                                        }
                                                                      }
                                                                    ]
                                                                  },
                                                                  "span": {
                                                                    "start": 3194,
                                                                    "end": 3201
                                                                  }
                                                                }
                                                              ],
                                                              "span": {
                                                                "start": 3169,
                                                                "end": 3207
                                                              }
                                                            }
                                                          ],
                                                          "finally": [
                                                            {
                                                              "kind": {
                                                                "Echo": [
                                                                  {
                                                                    "kind": {
                                                                      "Int": 3
                                                                    },
                                                                    "span": {
                                                                      "start": 3231,
                                                                      "end": 3232
                                                                    }
                                                                  }
                                                                ]
                                                              },
                                                              "span": {
                                                                "start": 3226,
                                                                "end": 3233
                                                              }
                                                            }
                                                          ]
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 3090,
                                                        "end": 3239
                                                      }
                                                    }
                                                  ],
                                                  "attributes": []
                                                }
                                              },
                                              "span": {
                                                "start": 3037,
                                                "end": 3241
                                              }
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 3032,
                                          "end": 3241
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 3031,
                                      "end": 3242
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 3026,
                                "end": 3242
                              }
                            }
                          },
                          "span": {
                            "start": 3026,
                            "end": 3242
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 3019,
                    "end": 3243
                  }
                }
              },
              "span": {
                "start": 3019,
                "end": 3244
              }
            }
          ],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "AssertionError"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 3254,
                    "end": 3268
                  }
                }
              ],
              "var": {
                "name": "e",
                "span": {
                  "start": 3269,
                  "end": 3271
                }
              },
              "body": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "MethodCall": {
                            "object": {
                              "kind": {
                                "Variable": "e"
                              },
                              "span": {
                                "start": 3284,
                                "end": 3286
                              }
                            },
                            "method": {
                              "kind": {
                                "Identifier": "getMessage"
                              },
                              "span": {
                                "start": 3288,
                                "end": 3298
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 3284,
                          "end": 3300
                        }
                      },
                      {
                        "kind": {
                          "Name": {
                            "parts": [
                              "PHP_EOL"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 3302,
                              "end": 3309
                            }
                          }
                        },
                        "span": {
                          "start": 3302,
                          "end": 3309
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 3279,
                    "end": 3310
                  }
                }
              ],
              "span": {
                "start": 3253,
                "end": 3312
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 3013,
        "end": 3312
      }
    },
    {
      "kind": {
        "TryCatch": {
          "body": [
            {
              "kind": {
                "Expression": {
                  "kind": {
                    "FunctionCall": {
                      "name": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "assert"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 3320,
                              "end": 3326
                            }
                          }
                        },
                        "span": {
                          "start": 3320,
                          "end": 3326
                        }
                      },
                      "args": [
                        {
                          "name": null,
                          "kind": {
                            "Value": {
                              "kind": {
                                "Binary": {
                                  "left": {
                                    "kind": {
                                      "Int": 0
                                    },
                                    "span": {
                                      "start": 3327,
                                      "end": 3328
                                    }
                                  },
                                  "op": "BooleanAnd",
                                  "right": {
                                    "kind": {
                                      "Parenthesized": {
                                        "kind": {
                                          "Assign": {
                                            "target": {
                                              "kind": {
                                                "Variable": "a"
                                              },
                                              "span": {
                                                "start": 3333,
                                                "end": 3335
                                              }
                                            },
                                            "op": "Assign",
                                            "value": {
                                              "kind": {
                                                "Closure": {
                                                  "is_static": false,
                                                  "by_ref": false,
                                                  "params": [],
                                                  "use_vars": [],
                                                  "return_type": {
                                                    "kind": {
                                                      "Nullable": {
                                                        "kind": {
                                                          "Named": {
                                                            "parts": [
                                                              "static"
                                                            ],
                                                            "kind": "Unqualified",
                                                            "span": {
                                                              "start": 3352,
                                                              "end": 3358
                                                            }
                                                          }
                                                        },
                                                        "span": {
                                                          "start": 3352,
                                                          "end": 3358
                                                        }
                                                      }
                                                    },
                                                    "span": {
                                                      "start": 3351,
                                                      "end": 3358
                                                    }
                                                  },
                                                  "body": [
                                                    {
                                                      "kind": {
                                                        "Declare": {
                                                          "directives": [
                                                            [
                                                              "C",
                                                              {
                                                                "kind": {
                                                                  "Int": 1
                                                                },
                                                                "span": {
                                                                  "start": 3375,
                                                                  "end": 3376
                                                                }
                                                              }
                                                            ]
                                                          ],
                                                          "body": {
                                                            "kind": {
                                                              "Block": [
                                                                {
                                                                  "kind": {
                                                                    "Echo": [
                                                                      {
                                                                        "kind": {
                                                                          "Int": 1
                                                                        },
                                                                        "span": {
                                                                          "start": 3385,
                                                                          "end": 3386
                                                                        }
                                                                      }
                                                                    ]
                                                                  },
                                                                  "span": {
                                                                    "start": 3380,
                                                                    "end": 3387
                                                                  }
                                                                }
                                                              ]
                                                            },
                                                            "span": {
                                                              "start": 3378,
                                                              "end": 3389
                                                            }
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 3365,
                                                        "end": 3389
                                                      }
                                                    },
                                                    {
                                                      "kind": {
                                                        "Expression": {
                                                          "kind": {
                                                            "Assign": {
                                                              "target": {
                                                                "kind": {
                                                                  "Variable": "x"
                                                                },
                                                                "span": {
                                                                  "start": 3394,
                                                                  "end": 3396
                                                                }
                                                              },
                                                              "op": "Assign",
                                                              "value": {
                                                                "kind": {
                                                                  "String": "'\"`$a"
                                                                },
                                                                "span": {
                                                                  "start": 3399,
                                                                  "end": 3407
                                                                }
                                                              }
                                                            }
                                                          },
                                                          "span": {
                                                            "start": 3394,
                                                            "end": 3407
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 3394,
                                                        "end": 3408
                                                      }
                                                    },
                                                    {
                                                      "kind": {
                                                        "Expression": {
                                                          "kind": {
                                                            "Assign": {
                                                              "target": {
                                                                "kind": {
                                                                  "Variable": "x"
                                                                },
                                                                "span": {
                                                                  "start": 3413,
                                                                  "end": 3415
                                                                }
                                                              },
                                                              "op": "Assign",
                                                              "value": {
                                                                "kind": {
                                                                  "InterpolatedString": [
                                                                    {
                                                                      "Literal": "'\"`"
                                                                    },
                                                                    {
                                                                      "Expr": {
                                                                        "kind": {
                                                                          "Variable": "a"
                                                                        },
                                                                        "span": {
                                                                          "start": 3423,
                                                                          "end": 3425
                                                                        }
                                                                      }
                                                                    }
                                                                  ]
                                                                },
                                                                "span": {
                                                                  "start": 3418,
                                                                  "end": 3426
                                                                }
                                                              }
                                                            }
                                                          },
                                                          "span": {
                                                            "start": 3413,
                                                            "end": 3426
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 3413,
                                                        "end": 3427
                                                      }
                                                    },
                                                    {
                                                      "kind": {
                                                        "Expression": {
                                                          "kind": {
                                                            "Assign": {
                                                              "target": {
                                                                "kind": {
                                                                  "Variable": "x"
                                                                },
                                                                "span": {
                                                                  "start": 3432,
                                                                  "end": 3434
                                                                }
                                                              },
                                                              "op": "Assign",
                                                              "value": {
                                                                "kind": {
                                                                  "ShellExec": [
                                                                    {
                                                                      "Literal": "'\"\\`"
                                                                    },
                                                                    {
                                                                      "Expr": {
                                                                        "kind": {
                                                                          "Variable": "a"
                                                                        },
                                                                        "span": {
                                                                          "start": 3442,
                                                                          "end": 3444
                                                                        }
                                                                      }
                                                                    }
                                                                  ]
                                                                },
                                                                "span": {
                                                                  "start": 3437,
                                                                  "end": 3445
                                                                }
                                                              }
                                                            }
                                                          },
                                                          "span": {
                                                            "start": 3432,
                                                            "end": 3445
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 3432,
                                                        "end": 3446
                                                      }
                                                    },
                                                    {
                                                      "kind": {
                                                        "Expression": {
                                                          "kind": {
                                                            "Assign": {
                                                              "target": {
                                                                "kind": {
                                                                  "Variable": "x"
                                                                },
                                                                "span": {
                                                                  "start": 3451,
                                                                  "end": 3453
                                                                }
                                                              },
                                                              "op": "Assign",
                                                              "value": {
                                                                "kind": {
                                                                  "InterpolatedString": [
                                                                    {
                                                                      "Expr": {
                                                                        "kind": {
                                                                          "Variable": "a"
                                                                        },
                                                                        "span": {
                                                                          "start": 3458,
                                                                          "end": 3460
                                                                        }
                                                                      }
                                                                    },
                                                                    {
                                                                      "Literal": "b"
                                                                    }
                                                                  ]
                                                                },
                                                                "span": {
                                                                  "start": 3456,
                                                                  "end": 3463
                                                                }
                                                              }
                                                            }
                                                          },
                                                          "span": {
                                                            "start": 3451,
                                                            "end": 3463
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 3451,
                                                        "end": 3464
                                                      }
                                                    },
                                                    {
                                                      "kind": {
                                                        "Expression": {
                                                          "kind": {
                                                            "Assign": {
                                                              "target": {
                                                                "kind": {
                                                                  "Variable": "x"
                                                                },
                                                                "span": {
                                                                  "start": 3469,
                                                                  "end": 3471
                                                                }
                                                              },
                                                              "op": "Assign",
                                                              "value": {
                                                                "kind": {
                                                                  "InterpolatedString": [
                                                                    {
                                                                      "Expr": {
                                                                        "kind": {
                                                                          "Variable": "a"
                                                                        },
                                                                        "span": {
                                                                          "start": 3477,
                                                                          "end": 3478
                                                                        }
                                                                      }
                                                                    },
                                                                    {
                                                                      "Literal": "b"
                                                                    }
                                                                  ]
                                                                },
                                                                "span": {
                                                                  "start": 3474,
                                                                  "end": 3481
                                                                }
                                                              }
                                                            }
                                                          },
                                                          "span": {
                                                            "start": 3469,
                                                            "end": 3481
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 3469,
                                                        "end": 3482
                                                      }
                                                    },
                                                    {
                                                      "kind": {
                                                        "Expression": {
                                                          "kind": {
                                                            "Assign": {
                                                              "target": {
                                                                "kind": {
                                                                  "Variable": "x"
                                                                },
                                                                "span": {
                                                                  "start": 3487,
                                                                  "end": 3489
                                                                }
                                                              },
                                                              "op": "Assign",
                                                              "value": {
                                                                "kind": {
                                                                  "InterpolatedString": [
                                                                    {
                                                                      "Literal": " "
                                                                    },
                                                                    {
                                                                      "Expr": {
                                                                        "kind": {
                                                                          "PropertyAccess": {
                                                                            "object": {
                                                                              "kind": {
                                                                                "Variable": "foo"
                                                                              },
                                                                              "span": {
                                                                                "start": 3495,
                                                                                "end": 3499
                                                                              }
                                                                            },
                                                                            "property": {
                                                                              "kind": {
                                                                                "Identifier": "bar"
                                                                              },
                                                                              "span": {
                                                                                "start": 3501,
                                                                                "end": 3504
                                                                              }
                                                                            }
                                                                          }
                                                                        },
                                                                        "span": {
                                                                          "start": 3495,
                                                                          "end": 3504
                                                                        }
                                                                      }
                                                                    },
                                                                    {
                                                                      "Literal": " "
                                                                    },
                                                                    {
                                                                      "Expr": {
                                                                        "kind": {
                                                                          "VariableVariable": {
                                                                            "kind": {
                                                                              "PropertyAccess": {
                                                                                "object": {
                                                                                  "kind": {
                                                                                    "Variable": "foo"
                                                                                  },
                                                                                  "span": {
                                                                                    "start": 3508,
                                                                                    "end": 3512
                                                                                  }
                                                                                },
                                                                                "property": {
                                                                                  "kind": {
                                                                                    "Identifier": "bar"
                                                                                  },
                                                                                  "span": {
                                                                                    "start": 3514,
                                                                                    "end": 3517
                                                                                  }
                                                                                }
                                                                              }
                                                                            },
                                                                            "span": {
                                                                              "start": 3508,
                                                                              "end": 3517
                                                                            }
                                                                          }
                                                                        },
                                                                        "span": {
                                                                          "start": 3506,
                                                                          "end": 3518
                                                                        }
                                                                      }
                                                                    },
                                                                    {
                                                                      "Literal": " "
                                                                    }
                                                                  ]
                                                                },
                                                                "span": {
                                                                  "start": 3492,
                                                                  "end": 3520
                                                                }
                                                              }
                                                            }
                                                          },
                                                          "span": {
                                                            "start": 3487,
                                                            "end": 3520
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 3487,
                                                        "end": 3521
                                                      }
                                                    },
                                                    {
                                                      "kind": {
                                                        "Expression": {
                                                          "kind": {
                                                            "Assign": {
                                                              "target": {
                                                                "kind": {
                                                                  "Variable": "x"
                                                                },
                                                                "span": {
                                                                  "start": 3526,
                                                                  "end": 3528
                                                                }
                                                              },
                                                              "op": "Assign",
                                                              "value": {
                                                                "kind": {
                                                                  "InterpolatedString": [
                                                                    {
                                                                      "Literal": " "
                                                                    },
                                                                    {
                                                                      "Expr": {
                                                                        "kind": {
                                                                          "VariableVariable": {
                                                                            "kind": {
                                                                              "String": "---"
                                                                            },
                                                                            "span": {
                                                                              "start": 3535,
                                                                              "end": 3540
                                                                            }
                                                                          }
                                                                        },
                                                                        "span": {
                                                                          "start": 3533,
                                                                          "end": 3541
                                                                        }
                                                                      }
                                                                    },
                                                                    {
                                                                      "Literal": " "
                                                                    }
                                                                  ]
                                                                },
                                                                "span": {
                                                                  "start": 3531,
                                                                  "end": 3543
                                                                }
                                                              }
                                                            }
                                                          },
                                                          "span": {
                                                            "start": 3526,
                                                            "end": 3543
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 3526,
                                                        "end": 3544
                                                      }
                                                    },
                                                    {
                                                      "kind": {
                                                        "Expression": {
                                                          "kind": {
                                                            "FunctionCall": {
                                                              "name": {
                                                                "kind": {
                                                                  "Name": {
                                                                    "parts": [
                                                                      "foo"
                                                                    ],
                                                                    "kind": "Unqualified",
                                                                    "span": {
                                                                      "start": 3549,
                                                                      "end": 3552
                                                                    }
                                                                  }
                                                                },
                                                                "span": {
                                                                  "start": 3549,
                                                                  "end": 3552
                                                                }
                                                              },
                                                              "args": []
                                                            }
                                                          },
                                                          "span": {
                                                            "start": 3549,
                                                            "end": 3554
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 3549,
                                                        "end": 3555
                                                      }
                                                    },
                                                    {
                                                      "kind": {
                                                        "Expression": {
                                                          "kind": {
                                                            "FunctionCall": {
                                                              "name": {
                                                                "kind": {
                                                                  "Name": {
                                                                    "parts": [
                                                                      "foo"
                                                                    ],
                                                                    "kind": "FullyQualified",
                                                                    "span": {
                                                                      "start": 3560,
                                                                      "end": 3564
                                                                    }
                                                                  }
                                                                },
                                                                "span": {
                                                                  "start": 3560,
                                                                  "end": 3564
                                                                }
                                                              },
                                                              "args": []
                                                            }
                                                          },
                                                          "span": {
                                                            "start": 3560,
                                                            "end": 3566
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 3560,
                                                        "end": 3567
                                                      }
                                                    },
                                                    {
                                                      "kind": {
                                                        "Expression": {
                                                          "kind": {
                                                            "FunctionCall": {
                                                              "name": {
                                                                "kind": {
                                                                  "Name": {
                                                                    "parts": [
                                                                      "foo"
                                                                    ],
                                                                    "kind": "Relative",
                                                                    "span": {
                                                                      "start": 3572,
                                                                      "end": 3585
                                                                    }
                                                                  }
                                                                },
                                                                "span": {
                                                                  "start": 3572,
                                                                  "end": 3585
                                                                }
                                                              },
                                                              "args": []
                                                            }
                                                          },
                                                          "span": {
                                                            "start": 3572,
                                                            "end": 3587
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 3572,
                                                        "end": 3588
                                                      }
                                                    },
                                                    {
                                                      "kind": {
                                                        "Expression": {
                                                          "kind": {
                                                            "Assign": {
                                                              "target": {
                                                                "kind": {
                                                                  "Variable": "x"
                                                                },
                                                                "span": {
                                                                  "start": 3593,
                                                                  "end": 3595
                                                                }
                                                              },
                                                              "op": "Assign",
                                                              "value": {
                                                                "kind": {
                                                                  "Name": {
                                                                    "parts": [
                                                                      "foo"
                                                                    ],
                                                                    "kind": "Unqualified",
                                                                    "span": {
                                                                      "start": 3598,
                                                                      "end": 3601
                                                                    }
                                                                  }
                                                                },
                                                                "span": {
                                                                  "start": 3598,
                                                                  "end": 3601
                                                                }
                                                              }
                                                            }
                                                          },
                                                          "span": {
                                                            "start": 3593,
                                                            "end": 3601
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 3593,
                                                        "end": 3602
                                                      }
                                                    },
                                                    {
                                                      "kind": {
                                                        "Expression": {
                                                          "kind": {
                                                            "Assign": {
                                                              "target": {
                                                                "kind": {
                                                                  "Variable": "x"
                                                                },
                                                                "span": {
                                                                  "start": 3607,
                                                                  "end": 3609
                                                                }
                                                              },
                                                              "op": "Assign",
                                                              "value": {
                                                                "kind": {
                                                                  "Name": {
                                                                    "parts": [
                                                                      "foo"
                                                                    ],
                                                                    "kind": "FullyQualified",
                                                                    "span": {
                                                                      "start": 3612,
                                                                      "end": 3616
                                                                    }
                                                                  }
                                                                },
                                                                "span": {
                                                                  "start": 3612,
                                                                  "end": 3616
                                                                }
                                                              }
                                                            }
                                                          },
                                                          "span": {
                                                            "start": 3607,
                                                            "end": 3616
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 3607,
                                                        "end": 3617
                                                      }
                                                    },
                                                    {
                                                      "kind": {
                                                        "Expression": {
                                                          "kind": {
                                                            "Assign": {
                                                              "target": {
                                                                "kind": {
                                                                  "Variable": "x"
                                                                },
                                                                "span": {
                                                                  "start": 3622,
                                                                  "end": 3624
                                                                }
                                                              },
                                                              "op": "Assign",
                                                              "value": {
                                                                "kind": {
                                                                  "Name": {
                                                                    "parts": [
                                                                      "foo"
                                                                    ],
                                                                    "kind": "Relative",
                                                                    "span": {
                                                                      "start": 3627,
                                                                      "end": 3640
                                                                    }
                                                                  }
                                                                },
                                                                "span": {
                                                                  "start": 3627,
                                                                  "end": 3640
                                                                }
                                                              }
                                                            }
                                                          },
                                                          "span": {
                                                            "start": 3622,
                                                            "end": 3640
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 3622,
                                                        "end": 3641
                                                      }
                                                    },
                                                    {
                                                      "kind": {
                                                        "Expression": {
                                                          "kind": {
                                                            "Assign": {
                                                              "target": {
                                                                "kind": {
                                                                  "Variable": "x"
                                                                },
                                                                "span": {
                                                                  "start": 3646,
                                                                  "end": 3648
                                                                }
                                                              },
                                                              "op": "Assign",
                                                              "value": {
                                                                "kind": {
                                                                  "New": {
                                                                    "class": {
                                                                      "kind": {
                                                                        "Name": {
                                                                          "parts": [
                                                                            "foo"
                                                                          ],
                                                                          "kind": "Unqualified",
                                                                          "span": {
                                                                            "start": 3655,
                                                                            "end": 3658
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 3655,
                                                                        "end": 3658
                                                                      }
                                                                    },
                                                                    "args": []
                                                                  }
                                                                },
                                                                "span": {
                                                                  "start": 3651,
                                                                  "end": 3660
                                                                }
                                                              }
                                                            }
                                                          },
                                                          "span": {
                                                            "start": 3646,
                                                            "end": 3660
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 3646,
                                                        "end": 3661
                                                      }
                                                    },
                                                    {
                                                      "kind": {
                                                        "Expression": {
                                                          "kind": {
                                                            "Assign": {
                                                              "target": {
                                                                "kind": {
                                                                  "Variable": "x"
                                                                },
                                                                "span": {
                                                                  "start": 3666,
                                                                  "end": 3668
                                                                }
                                                              },
                                                              "op": "Assign",
                                                              "value": {
                                                                "kind": {
                                                                  "New": {
                                                                    "class": {
                                                                      "kind": {
                                                                        "Name": {
                                                                          "parts": [
                                                                            "foo"
                                                                          ],
                                                                          "kind": "FullyQualified",
                                                                          "span": {
                                                                            "start": 3675,
                                                                            "end": 3679
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 3675,
                                                                        "end": 3679
                                                                      }
                                                                    },
                                                                    "args": []
                                                                  }
                                                                },
                                                                "span": {
                                                                  "start": 3671,
                                                                  "end": 3681
                                                                }
                                                              }
                                                            }
                                                          },
                                                          "span": {
                                                            "start": 3666,
                                                            "end": 3681
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 3666,
                                                        "end": 3682
                                                      }
                                                    },
                                                    {
                                                      "kind": {
                                                        "Expression": {
                                                          "kind": {
                                                            "Assign": {
                                                              "target": {
                                                                "kind": {
                                                                  "Variable": "x"
                                                                },
                                                                "span": {
                                                                  "start": 3687,
                                                                  "end": 3689
                                                                }
                                                              },
                                                              "op": "Assign",
                                                              "value": {
                                                                "kind": {
                                                                  "New": {
                                                                    "class": {
                                                                      "kind": {
                                                                        "Name": {
                                                                          "parts": [
                                                                            "foo"
                                                                          ],
                                                                          "kind": "Relative",
                                                                          "span": {
                                                                            "start": 3696,
                                                                            "end": 3709
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 3696,
                                                                        "end": 3709
                                                                      }
                                                                    },
                                                                    "args": []
                                                                  }
                                                                },
                                                                "span": {
                                                                  "start": 3692,
                                                                  "end": 3711
                                                                }
                                                              }
                                                            }
                                                          },
                                                          "span": {
                                                            "start": 3687,
                                                            "end": 3711
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 3687,
                                                        "end": 3712
                                                      }
                                                    },
                                                    {
                                                      "kind": {
                                                        "If": {
                                                          "condition": {
                                                            "kind": {
                                                              "Variable": "a"
                                                            },
                                                            "span": {
                                                              "start": 3721,
                                                              "end": 3723
                                                            }
                                                          },
                                                          "then_branch": {
                                                            "kind": {
                                                              "Block": []
                                                            },
                                                            "span": {
                                                              "start": 3725,
                                                              "end": 3732
                                                            }
                                                          },
                                                          "elseif_branches": [
                                                            {
                                                              "condition": {
                                                                "kind": {
                                                                  "Variable": "b"
                                                                },
                                                                "span": {
                                                                  "start": 3741,
                                                                  "end": 3743
                                                                }
                                                              },
                                                              "body": {
                                                                "kind": {
                                                                  "Block": []
                                                                },
                                                                "span": {
                                                                  "start": 3745,
                                                                  "end": 3752
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 3740,
                                                                "end": 3752
                                                              }
                                                            }
                                                          ],
                                                          "else_branch": null
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 3717,
                                                        "end": 3752
                                                      }
                                                    },
                                                    {
                                                      "kind": {
                                                        "If": {
                                                          "condition": {
                                                            "kind": {
                                                              "Variable": "a"
                                                            },
                                                            "span": {
                                                              "start": 3761,
                                                              "end": 3763
                                                            }
                                                          },
                                                          "then_branch": {
                                                            "kind": "Nop",
                                                            "span": {
                                                              "start": 3764,
                                                              "end": 3765
                                                            }
                                                          },
                                                          "elseif_branches": [],
                                                          "else_branch": {
                                                            "kind": "Nop",
                                                            "span": {
                                                              "start": 3770,
                                                              "end": 3771
                                                            }
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 3757,
                                                        "end": 3771
                                                      }
                                                    }
                                                  ],
                                                  "attributes": []
                                                }
                                              },
                                              "span": {
                                                "start": 3338,
                                                "end": 3773
                                              }
                                            }
                                          }
                                        },
                                        "span": {
                                          "start": 3333,
                                          "end": 3773
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 3332,
                                      "end": 3774
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 3327,
                                "end": 3774
                              }
                            }
                          },
                          "span": {
                            "start": 3327,
                            "end": 3774
                          }
                        }
                      ]
                    }
                  },
                  "span": {
                    "start": 3320,
                    "end": 3775
                  }
                }
              },
              "span": {
                "start": 3320,
                "end": 3776
              }
            }
          ],
          "catches": [
            {
              "types": [
                {
                  "parts": [
                    "AssertionError"
                  ],
                  "kind": "Unqualified",
                  "span": {
                    "start": 3786,
                    "end": 3800
                  }
                }
              ],
              "var": {
                "name": "e",
                "span": {
                  "start": 3801,
                  "end": 3803
                }
              },
              "body": [
                {
                  "kind": {
                    "Echo": [
                      {
                        "kind": {
                          "MethodCall": {
                            "object": {
                              "kind": {
                                "Variable": "e"
                              },
                              "span": {
                                "start": 3816,
                                "end": 3818
                              }
                            },
                            "method": {
                              "kind": {
                                "Identifier": "getMessage"
                              },
                              "span": {
                                "start": 3820,
                                "end": 3830
                              }
                            },
                            "args": []
                          }
                        },
                        "span": {
                          "start": 3816,
                          "end": 3832
                        }
                      },
                      {
                        "kind": {
                          "Name": {
                            "parts": [
                              "PHP_EOL"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 3834,
                              "end": 3841
                            }
                          }
                        },
                        "span": {
                          "start": 3834,
                          "end": 3841
                        }
                      }
                    ]
                  },
                  "span": {
                    "start": 3811,
                    "end": 3842
                  }
                }
              ],
              "span": {
                "start": 3785,
                "end": 3844
              }
            }
          ],
          "finally": null
        }
      },
      "span": {
        "start": 3314,
        "end": 3844
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 3844
  }
}
