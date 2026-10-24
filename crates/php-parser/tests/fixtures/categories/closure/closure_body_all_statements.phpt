===source===
<?php
assert(0 && ($a = function () {
    global $a, $$b;
    static $c, $d = 0;
    unset($e);
    $x = isset($a) && !empty($b) || eval($c);
    list($a, $b, $c) = [1, 2=>'x', 'z'=>'c'];
    @foo();
    $y = clone $x;
    yield 1 => 2;
    yield from $x;
}));

assert(0 && ($a = function &(array &$a, ?X $b = null) use ($c,&$d) : ?X {
    abstract class A extends B implements C, D {
        const X = 12;
        public $a = 1, $b;
        abstract function foo();

        static private function f1() {
            for ($i = 0, $j = 100; $i < $j; $i++, --$j) {
                $s[$i] = $a[$j];
            }
            foreach ($a as $key => &$val) {
                print "$key => $val\n";
            }
            do {
                $i--;
            } while ($s[$i]);
            $x = foo($a + 1, 4, ...[1,2,3]);
            $x = ${$a . "_1"}::foo();
            $x = $x->{$a . "_1"}();
            $x = C::${$z . "_1"};
            $x?->y();
            foo(bar: $x);
        }
    }
}));

assert(0 && ($a = function &(array &...$a) {
    final class A {
        final protected function f2() {
            if ($x == 1) {
                return 1;
            } else if ($x == 2) {
                return 2;
            }
L0:
            switch ($x) {
                case 4: break;
                case 6: break 2;
                case 8: goto L0;
                default: return;
            }
        }
    }
    class B {
        use T1, T2 {
            T1::foo insteadof foo;
            T2::foo as bar;
            ops as protected x;
        }
    }
    declare(A=1,B=2);
    try {
        $i++;
    } catch (MyException $e) {
        echo 1;
    } finally {
        echo 3;
    }
}));

assert(0 && ($a = function (): ?static {
    declare(C=1) { echo 1; }
    $x = `'"\`$a`;
    $x = "${a}b";
    $x = " {$foo->bar} ${$foo->bar} ";
    $x = namespace\foo;
    $x = new namespace\foo();
    if ($a) {
    } elseif ($b) {
    }
    if ($a); else;
}));
===errors <=7.4===
'nullsafe operator (?->)' requires PHP 8.0 or higher
'named arguments' requires PHP 8.0 or higher
'static type' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '->' (T_OBJECT_OPERATOR) in Standard input code on line 34
===ast===
{
  "stmts": [
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
                      "start": 6,
                      "end": 12
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 12
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
                              "start": 13,
                              "end": 14
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
                                        "start": 19,
                                        "end": 21
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
                                                      "start": 49,
                                                      "end": 51
                                                    }
                                                  },
                                                  {
                                                    "kind": {
                                                      "VariableVariable": {
                                                        "kind": {
                                                          "Variable": "b"
                                                        },
                                                        "span": {
                                                          "start": 54,
                                                          "end": 56
                                                        }
                                                      }
                                                    },
                                                    "span": {
                                                      "start": 53,
                                                      "end": 56
                                                    }
                                                  }
                                                ]
                                              },
                                              "span": {
                                                "start": 42,
                                                "end": 57
                                              }
                                            },
                                            {
                                              "kind": {
                                                "StaticVar": [
                                                  {
                                                    "name": {
                                                      "name": "c",
                                                      "span": {
                                                        "start": 69,
                                                        "end": 71
                                                      }
                                                    },
                                                    "default": null,
                                                    "span": {
                                                      "start": 69,
                                                      "end": 71
                                                    }
                                                  },
                                                  {
                                                    "name": {
                                                      "name": "d",
                                                      "span": {
                                                        "start": 73,
                                                        "end": 75
                                                      }
                                                    },
                                                    "default": {
                                                      "kind": {
                                                        "Int": 0
                                                      },
                                                      "span": {
                                                        "start": 78,
                                                        "end": 79
                                                      }
                                                    },
                                                    "span": {
                                                      "start": 73,
                                                      "end": 79
                                                    }
                                                  }
                                                ]
                                              },
                                              "span": {
                                                "start": 62,
                                                "end": 80
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
                                                      "start": 91,
                                                      "end": 93
                                                    }
                                                  }
                                                ]
                                              },
                                              "span": {
                                                "start": 85,
                                                "end": 95
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
                                                          "start": 100,
                                                          "end": 102
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
                                                                            "start": 111,
                                                                            "end": 113
                                                                          }
                                                                        }
                                                                      ]
                                                                    },
                                                                    "span": {
                                                                      "start": 105,
                                                                      "end": 114
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
                                                                                "start": 125,
                                                                                "end": 127
                                                                              }
                                                                            }
                                                                          },
                                                                          "span": {
                                                                            "start": 119,
                                                                            "end": 128
                                                                          }
                                                                        }
                                                                      }
                                                                    },
                                                                    "span": {
                                                                      "start": 118,
                                                                      "end": 128
                                                                    }
                                                                  }
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 105,
                                                                "end": 128
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
                                                                    "start": 137,
                                                                    "end": 139
                                                                  }
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 132,
                                                                "end": 140
                                                              }
                                                            }
                                                          }
                                                        },
                                                        "span": {
                                                          "start": 105,
                                                          "end": 140
                                                        }
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 100,
                                                    "end": 140
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 100,
                                                "end": 141
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
                                                                    "start": 151,
                                                                    "end": 153
                                                                  }
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 151,
                                                                "end": 153
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
                                                                    "start": 155,
                                                                    "end": 157
                                                                  }
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 155,
                                                                "end": 157
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
                                                                    "start": 159,
                                                                    "end": 161
                                                                  }
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 159,
                                                                "end": 161
                                                              }
                                                            }
                                                          ]
                                                        },
                                                        "span": {
                                                          "start": 146,
                                                          "end": 162
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
                                                                    "start": 166,
                                                                    "end": 167
                                                                  }
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 166,
                                                                "end": 167
                                                              }
                                                            },
                                                            {
                                                              "key": {
                                                                "kind": {
                                                                  "Int": 2
                                                                },
                                                                "span": {
                                                                  "start": 169,
                                                                  "end": 170
                                                                }
                                                              },
                                                              "kind": {
                                                                "Value": {
                                                                  "kind": {
                                                                    "String": "x"
                                                                  },
                                                                  "span": {
                                                                    "start": 172,
                                                                    "end": 175
                                                                  }
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 169,
                                                                "end": 175
                                                              }
                                                            },
                                                            {
                                                              "key": {
                                                                "kind": {
                                                                  "String": "z"
                                                                },
                                                                "span": {
                                                                  "start": 177,
                                                                  "end": 180
                                                                }
                                                              },
                                                              "kind": {
                                                                "Value": {
                                                                  "kind": {
                                                                    "String": "c"
                                                                  },
                                                                  "span": {
                                                                    "start": 182,
                                                                    "end": 185
                                                                  }
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 177,
                                                                "end": 185
                                                              }
                                                            }
                                                          ]
                                                        },
                                                        "span": {
                                                          "start": 165,
                                                          "end": 186
                                                        }
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 146,
                                                    "end": 186
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 146,
                                                "end": 187
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
                                                                  "start": 193,
                                                                  "end": 196
                                                                }
                                                              }
                                                            },
                                                            "span": {
                                                              "start": 193,
                                                              "end": 196
                                                            }
                                                          },
                                                          "args": []
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 193,
                                                        "end": 198
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 192,
                                                    "end": 198
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 192,
                                                "end": 199
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
                                                          "start": 204,
                                                          "end": 206
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
                                                              "start": 215,
                                                              "end": 217
                                                            }
                                                          }
                                                        },
                                                        "span": {
                                                          "start": 209,
                                                          "end": 217
                                                        }
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 204,
                                                    "end": 217
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 204,
                                                "end": 218
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
                                                          "start": 229,
                                                          "end": 230
                                                        }
                                                      },
                                                      "value": {
                                                        "kind": {
                                                          "Int": 2
                                                        },
                                                        "span": {
                                                          "start": 234,
                                                          "end": 235
                                                        }
                                                      },
                                                      "is_from": false
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 223,
                                                    "end": 235
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 223,
                                                "end": 236
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
                                                          "start": 252,
                                                          "end": 254
                                                        }
                                                      },
                                                      "is_from": true
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 241,
                                                    "end": 254
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 241,
                                                "end": 255
                                              }
                                            }
                                          ],
                                          "attributes": []
                                        }
                                      },
                                      "span": {
                                        "start": 24,
                                        "end": 257
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 19,
                                  "end": 257
                                }
                              }
                            },
                            "span": {
                              "start": 18,
                              "end": 258
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 13,
                        "end": 258
                      }
                    }
                  },
                  "span": {
                    "start": 13,
                    "end": 258
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 259
          }
        }
      },
      "span": {
        "start": 6,
        "end": 260
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
                      "assert"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 262,
                      "end": 268
                    }
                  }
                },
                "span": {
                  "start": 262,
                  "end": 268
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
                              "start": 269,
                              "end": 270
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
                                        "start": 275,
                                        "end": 277
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
                                                  "start": 298,
                                                  "end": 300
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
                                                      "start": 291,
                                                      "end": 296
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 291,
                                                  "end": 296
                                                }
                                              },
                                              "default": null,
                                              "by_ref": true,
                                              "variadic": false,
                                              "attributes": [],
                                              "span": {
                                                "start": 291,
                                                "end": 300
                                              }
                                            },
                                            {
                                              "name": {
                                                "name": "b",
                                                "span": {
                                                  "start": 305,
                                                  "end": 307
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
                                                          "start": 303,
                                                          "end": 304
                                                        }
                                                      }
                                                    },
                                                    "span": {
                                                      "start": 303,
                                                      "end": 304
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 302,
                                                  "end": 304
                                                }
                                              },
                                              "default": {
                                                "kind": "Null",
                                                "span": {
                                                  "start": 310,
                                                  "end": 314
                                                }
                                              },
                                              "by_ref": false,
                                              "variadic": false,
                                              "attributes": [],
                                              "span": {
                                                "start": 302,
                                                "end": 314
                                              }
                                            }
                                          ],
                                          "use_vars": [
                                            {
                                              "name": {
                                                "name": "c",
                                                "span": {
                                                  "start": 321,
                                                  "end": 323
                                                }
                                              },
                                              "by_ref": false,
                                              "span": {
                                                "start": 321,
                                                "end": 323
                                              }
                                            },
                                            {
                                              "name": {
                                                "name": "d",
                                                "span": {
                                                  "start": 325,
                                                  "end": 327
                                                }
                                              },
                                              "by_ref": true,
                                              "span": {
                                                "start": 324,
                                                "end": 327
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
                                                      "start": 332,
                                                      "end": 333
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 332,
                                                  "end": 333
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 331,
                                              "end": 333
                                            }
                                          },
                                          "body": [
                                            {
                                              "kind": {
                                                "Class": {
                                                  "name": {
                                                    "name": "A",
                                                    "span": {
                                                      "start": 355,
                                                      "end": 356
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
                                                      "start": 365,
                                                      "end": 366
                                                    }
                                                  },
                                                  "implements": [
                                                    {
                                                      "parts": [
                                                        "C"
                                                      ],
                                                      "kind": "Unqualified",
                                                      "span": {
                                                        "start": 378,
                                                        "end": 379
                                                      }
                                                    },
                                                    {
                                                      "parts": [
                                                        "D"
                                                      ],
                                                      "kind": "Unqualified",
                                                      "span": {
                                                        "start": 381,
                                                        "end": 382
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
                                                              "start": 399,
                                                              "end": 400
                                                            }
                                                          },
                                                          "value": {
                                                            "kind": {
                                                              "Int": 12
                                                            },
                                                            "span": {
                                                              "start": 403,
                                                              "end": 405
                                                            }
                                                          },
                                                          "attributes": []
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 393,
                                                        "end": 406
                                                      }
                                                    },
                                                    {
                                                      "kind": {
                                                        "Property": {
                                                          "name": {
                                                            "name": "a",
                                                            "span": {
                                                              "start": 422,
                                                              "end": 424
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
                                                              "start": 427,
                                                              "end": 428
                                                            }
                                                          },
                                                          "attributes": []
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 415,
                                                        "end": 428
                                                      }
                                                    },
                                                    {
                                                      "kind": {
                                                        "Property": {
                                                          "name": {
                                                            "name": "b",
                                                            "span": {
                                                              "start": 430,
                                                              "end": 432
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
                                                        "start": 430,
                                                        "end": 432
                                                      }
                                                    },
                                                    {
                                                      "kind": {
                                                        "Method": {
                                                          "name": {
                                                            "name": "foo",
                                                            "span": {
                                                              "start": 460,
                                                              "end": 463
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
                                                        "start": 442,
                                                        "end": 466
                                                      }
                                                    },
                                                    {
                                                      "kind": {
                                                        "Method": {
                                                          "name": {
                                                            "name": "f1",
                                                            "span": {
                                                              "start": 500,
                                                              "end": 502
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
                                                                              "start": 524,
                                                                              "end": 526
                                                                            }
                                                                          },
                                                                          "op": "Assign",
                                                                          "value": {
                                                                            "kind": {
                                                                              "Int": 0
                                                                            },
                                                                            "span": {
                                                                              "start": 529,
                                                                              "end": 530
                                                                            }
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 524,
                                                                        "end": 530
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
                                                                              "start": 532,
                                                                              "end": 534
                                                                            }
                                                                          },
                                                                          "op": "Assign",
                                                                          "value": {
                                                                            "kind": {
                                                                              "Int": 100
                                                                            },
                                                                            "span": {
                                                                              "start": 537,
                                                                              "end": 540
                                                                            }
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 532,
                                                                        "end": 540
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
                                                                              "start": 542,
                                                                              "end": 544
                                                                            }
                                                                          },
                                                                          "op": "Less",
                                                                          "right": {
                                                                            "kind": {
                                                                              "Variable": "j"
                                                                            },
                                                                            "span": {
                                                                              "start": 547,
                                                                              "end": 549
                                                                            }
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 542,
                                                                        "end": 549
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
                                                                              "start": 551,
                                                                              "end": 553
                                                                            }
                                                                          },
                                                                          "op": "PostIncrement"
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 551,
                                                                        "end": 555
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
                                                                              "start": 559,
                                                                              "end": 561
                                                                            }
                                                                          }
                                                                        }
                                                                      },
                                                                      "span": {
                                                                        "start": 557,
                                                                        "end": 561
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
                                                                                            "start": 581,
                                                                                            "end": 583
                                                                                          }
                                                                                        },
                                                                                        "index": {
                                                                                          "kind": {
                                                                                            "Variable": "i"
                                                                                          },
                                                                                          "span": {
                                                                                            "start": 584,
                                                                                            "end": 586
                                                                                          }
                                                                                        }
                                                                                      }
                                                                                    },
                                                                                    "span": {
                                                                                      "start": 581,
                                                                                      "end": 587
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
                                                                                            "start": 590,
                                                                                            "end": 592
                                                                                          }
                                                                                        },
                                                                                        "index": {
                                                                                          "kind": {
                                                                                            "Variable": "j"
                                                                                          },
                                                                                          "span": {
                                                                                            "start": 593,
                                                                                            "end": 595
                                                                                          }
                                                                                        }
                                                                                      }
                                                                                    },
                                                                                    "span": {
                                                                                      "start": 590,
                                                                                      "end": 596
                                                                                    }
                                                                                  }
                                                                                }
                                                                              },
                                                                              "span": {
                                                                                "start": 581,
                                                                                "end": 596
                                                                              }
                                                                            }
                                                                          },
                                                                          "span": {
                                                                            "start": 581,
                                                                            "end": 597
                                                                          }
                                                                        }
                                                                      ]
                                                                    },
                                                                    "span": {
                                                                      "start": 563,
                                                                      "end": 611
                                                                    }
                                                                  }
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 519,
                                                                "end": 611
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
                                                                      "start": 633,
                                                                      "end": 635
                                                                    }
                                                                  },
                                                                  "key": {
                                                                    "kind": {
                                                                      "Variable": "key"
                                                                    },
                                                                    "span": {
                                                                      "start": 639,
                                                                      "end": 643
                                                                    }
                                                                  },
                                                                  "value": {
                                                                    "kind": {
                                                                      "Variable": "val"
                                                                    },
                                                                    "span": {
                                                                      "start": 648,
                                                                      "end": 652
                                                                    }
                                                                  },
                                                                  "by_ref": true,
                                                                  "by_ref_span": {
                                                                    "start": 647,
                                                                    "end": 648
                                                                  },
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
                                                                                            "start": 679,
                                                                                            "end": 683
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
                                                                                            "start": 687,
                                                                                            "end": 691
                                                                                          }
                                                                                        }
                                                                                      },
                                                                                      {
                                                                                        "Literal": "\n"
                                                                                      }
                                                                                    ]
                                                                                  },
                                                                                  "span": {
                                                                                    "start": 678,
                                                                                    "end": 694
                                                                                  }
                                                                                }
                                                                              },
                                                                              "span": {
                                                                                "start": 672,
                                                                                "end": 694
                                                                              }
                                                                            }
                                                                          },
                                                                          "span": {
                                                                            "start": 672,
                                                                            "end": 695
                                                                          }
                                                                        }
                                                                      ]
                                                                    },
                                                                    "span": {
                                                                      "start": 654,
                                                                      "end": 709
                                                                    }
                                                                  }
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 624,
                                                                "end": 709
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
                                                                                      "start": 743,
                                                                                      "end": 745
                                                                                    }
                                                                                  },
                                                                                  "op": "PostDecrement"
                                                                                }
                                                                              },
                                                                              "span": {
                                                                                "start": 743,
                                                                                "end": 747
                                                                              }
                                                                            }
                                                                          },
                                                                          "span": {
                                                                            "start": 743,
                                                                            "end": 748
                                                                          }
                                                                        }
                                                                      ]
                                                                    },
                                                                    "span": {
                                                                      "start": 725,
                                                                      "end": 762
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
                                                                            "start": 770,
                                                                            "end": 772
                                                                          }
                                                                        },
                                                                        "index": {
                                                                          "kind": {
                                                                            "Variable": "i"
                                                                          },
                                                                          "span": {
                                                                            "start": 773,
                                                                            "end": 775
                                                                          }
                                                                        }
                                                                      }
                                                                    },
                                                                    "span": {
                                                                      "start": 770,
                                                                      "end": 776
                                                                    }
                                                                  }
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 722,
                                                                "end": 778
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
                                                                          "start": 791,
                                                                          "end": 793
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
                                                                                    "start": 796,
                                                                                    "end": 799
                                                                                  }
                                                                                }
                                                                              },
                                                                              "span": {
                                                                                "start": 796,
                                                                                "end": 799
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
                                                                                            "start": 800,
                                                                                            "end": 802
                                                                                          }
                                                                                        },
                                                                                        "op": "Add",
                                                                                        "right": {
                                                                                          "kind": {
                                                                                            "Int": 1
                                                                                          },
                                                                                          "span": {
                                                                                            "start": 805,
                                                                                            "end": 806
                                                                                          }
                                                                                        }
                                                                                      }
                                                                                    },
                                                                                    "span": {
                                                                                      "start": 800,
                                                                                      "end": 806
                                                                                    }
                                                                                  }
                                                                                },
                                                                                "span": {
                                                                                  "start": 800,
                                                                                  "end": 806
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
                                                                                      "start": 808,
                                                                                      "end": 809
                                                                                    }
                                                                                  }
                                                                                },
                                                                                "span": {
                                                                                  "start": 808,
                                                                                  "end": 809
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
                                                                                                "start": 815,
                                                                                                "end": 816
                                                                                              }
                                                                                            }
                                                                                          },
                                                                                          "span": {
                                                                                            "start": 815,
                                                                                            "end": 816
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
                                                                                                "start": 817,
                                                                                                "end": 818
                                                                                              }
                                                                                            }
                                                                                          },
                                                                                          "span": {
                                                                                            "start": 817,
                                                                                            "end": 818
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
                                                                                                "start": 819,
                                                                                                "end": 820
                                                                                              }
                                                                                            }
                                                                                          },
                                                                                          "span": {
                                                                                            "start": 819,
                                                                                            "end": 820
                                                                                          }
                                                                                        }
                                                                                      ]
                                                                                    },
                                                                                    "span": {
                                                                                      "start": 814,
                                                                                      "end": 821
                                                                                    }
                                                                                  }
                                                                                },
                                                                                "span": {
                                                                                  "start": 811,
                                                                                  "end": 821
                                                                                }
                                                                              }
                                                                            ]
                                                                          }
                                                                        },
                                                                        "span": {
                                                                          "start": 796,
                                                                          "end": 822
                                                                        }
                                                                      }
                                                                    }
                                                                  },
                                                                  "span": {
                                                                    "start": 791,
                                                                    "end": 822
                                                                  }
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 791,
                                                                "end": 823
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
                                                                          "start": 836,
                                                                          "end": 838
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
                                                                                          "start": 843,
                                                                                          "end": 845
                                                                                        }
                                                                                      },
                                                                                      "op": "Concat",
                                                                                      "right": {
                                                                                        "kind": {
                                                                                          "String": "_1"
                                                                                        },
                                                                                        "span": {
                                                                                          "start": 848,
                                                                                          "end": 852
                                                                                        }
                                                                                      }
                                                                                    }
                                                                                  },
                                                                                  "span": {
                                                                                    "start": 843,
                                                                                    "end": 852
                                                                                  }
                                                                                }
                                                                              },
                                                                              "span": {
                                                                                "start": 841,
                                                                                "end": 853
                                                                              }
                                                                            },
                                                                            "method": {
                                                                              "kind": {
                                                                                "Identifier": "foo"
                                                                              },
                                                                              "span": {
                                                                                "start": 855,
                                                                                "end": 858
                                                                              }
                                                                            },
                                                                            "args": []
                                                                          }
                                                                        },
                                                                        "span": {
                                                                          "start": 841,
                                                                          "end": 860
                                                                        }
                                                                      }
                                                                    }
                                                                  },
                                                                  "span": {
                                                                    "start": 836,
                                                                    "end": 860
                                                                  }
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 836,
                                                                "end": 861
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
                                                                          "start": 874,
                                                                          "end": 876
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
                                                                                "start": 879,
                                                                                "end": 881
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
                                                                                      "start": 884,
                                                                                      "end": 886
                                                                                    }
                                                                                  },
                                                                                  "op": "Concat",
                                                                                  "right": {
                                                                                    "kind": {
                                                                                      "String": "_1"
                                                                                    },
                                                                                    "span": {
                                                                                      "start": 889,
                                                                                      "end": 893
                                                                                    }
                                                                                  }
                                                                                }
                                                                              },
                                                                              "span": {
                                                                                "start": 884,
                                                                                "end": 893
                                                                              }
                                                                            },
                                                                            "args": []
                                                                          }
                                                                        },
                                                                        "span": {
                                                                          "start": 879,
                                                                          "end": 896
                                                                        }
                                                                      }
                                                                    }
                                                                  },
                                                                  "span": {
                                                                    "start": 874,
                                                                    "end": 896
                                                                  }
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 874,
                                                                "end": 897
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
                                                                          "start": 910,
                                                                          "end": 912
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
                                                                                    "start": 915,
                                                                                    "end": 916
                                                                                  }
                                                                                }
                                                                              },
                                                                              "span": {
                                                                                "start": 915,
                                                                                "end": 916
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
                                                                                          "start": 920,
                                                                                          "end": 922
                                                                                        }
                                                                                      },
                                                                                      "op": "Concat",
                                                                                      "right": {
                                                                                        "kind": {
                                                                                          "String": "_1"
                                                                                        },
                                                                                        "span": {
                                                                                          "start": 925,
                                                                                          "end": 929
                                                                                        }
                                                                                      }
                                                                                    }
                                                                                  },
                                                                                  "span": {
                                                                                    "start": 920,
                                                                                    "end": 929
                                                                                  }
                                                                                }
                                                                              },
                                                                              "span": {
                                                                                "start": 918,
                                                                                "end": 930
                                                                              }
                                                                            }
                                                                          }
                                                                        },
                                                                        "span": {
                                                                          "start": 915,
                                                                          "end": 930
                                                                        }
                                                                      }
                                                                    }
                                                                  },
                                                                  "span": {
                                                                    "start": 910,
                                                                    "end": 930
                                                                  }
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 910,
                                                                "end": 931
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
                                                                          "start": 944,
                                                                          "end": 946
                                                                        }
                                                                      },
                                                                      "method": {
                                                                        "kind": {
                                                                          "Identifier": "y"
                                                                        },
                                                                        "span": {
                                                                          "start": 949,
                                                                          "end": 950
                                                                        }
                                                                      },
                                                                      "args": []
                                                                    }
                                                                  },
                                                                  "span": {
                                                                    "start": 944,
                                                                    "end": 952
                                                                  }
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 944,
                                                                "end": 953
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
                                                                              "start": 966,
                                                                              "end": 969
                                                                            }
                                                                          }
                                                                        },
                                                                        "span": {
                                                                          "start": 966,
                                                                          "end": 969
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
                                                                              "start": 970,
                                                                              "end": 973
                                                                            }
                                                                          },
                                                                          "kind": {
                                                                            "Value": {
                                                                              "kind": {
                                                                                "Variable": "x"
                                                                              },
                                                                              "span": {
                                                                                "start": 975,
                                                                                "end": 977
                                                                              }
                                                                            }
                                                                          },
                                                                          "span": {
                                                                            "start": 970,
                                                                            "end": 977
                                                                          }
                                                                        }
                                                                      ]
                                                                    }
                                                                  },
                                                                  "span": {
                                                                    "start": 966,
                                                                    "end": 978
                                                                  }
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 966,
                                                                "end": 979
                                                              }
                                                            }
                                                          ],
                                                          "attributes": []
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 476,
                                                        "end": 989
                                                      }
                                                    }
                                                  ],
                                                  "attributes": []
                                                }
                                              },
                                              "span": {
                                                "start": 349,
                                                "end": 995
                                              }
                                            }
                                          ],
                                          "attributes": []
                                        }
                                      },
                                      "span": {
                                        "start": 280,
                                        "end": 997
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 275,
                                  "end": 997
                                }
                              }
                            },
                            "span": {
                              "start": 274,
                              "end": 998
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 269,
                        "end": 998
                      }
                    }
                  },
                  "span": {
                    "start": 269,
                    "end": 998
                  }
                }
              ]
            }
          },
          "span": {
            "start": 262,
            "end": 999
          }
        }
      },
      "span": {
        "start": 262,
        "end": 1000
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
                      "assert"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 1002,
                      "end": 1008
                    }
                  }
                },
                "span": {
                  "start": 1002,
                  "end": 1008
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
                              "start": 1009,
                              "end": 1010
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
                                        "start": 1015,
                                        "end": 1017
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
                                                  "start": 1041,
                                                  "end": 1043
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
                                                      "start": 1031,
                                                      "end": 1036
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 1031,
                                                  "end": 1036
                                                }
                                              },
                                              "default": null,
                                              "by_ref": true,
                                              "variadic": true,
                                              "attributes": [],
                                              "span": {
                                                "start": 1031,
                                                "end": 1043
                                              }
                                            }
                                          ],
                                          "use_vars": [],
                                          "return_type": null,
                                          "body": [
                                            {
                                              "kind": {
                                                "Class": {
                                                  "name": {
                                                    "name": "A",
                                                    "span": {
                                                      "start": 1063,
                                                      "end": 1064
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
                                                              "start": 1100,
                                                              "end": 1102
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
                                                                      "Binary": {
                                                                        "left": {
                                                                          "kind": {
                                                                            "Variable": "x"
                                                                          },
                                                                          "span": {
                                                                            "start": 1123,
                                                                            "end": 1125
                                                                          }
                                                                        },
                                                                        "op": "Equal",
                                                                        "right": {
                                                                          "kind": {
                                                                            "Int": 1
                                                                          },
                                                                          "span": {
                                                                            "start": 1129,
                                                                            "end": 1130
                                                                          }
                                                                        }
                                                                      }
                                                                    },
                                                                    "span": {
                                                                      "start": 1123,
                                                                      "end": 1130
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
                                                                                "start": 1157,
                                                                                "end": 1158
                                                                              }
                                                                            }
                                                                          },
                                                                          "span": {
                                                                            "start": 1150,
                                                                            "end": 1159
                                                                          }
                                                                        }
                                                                      ]
                                                                    },
                                                                    "span": {
                                                                      "start": 1132,
                                                                      "end": 1173
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
                                                                                  "start": 1183,
                                                                                  "end": 1185
                                                                                }
                                                                              },
                                                                              "op": "Equal",
                                                                              "right": {
                                                                                "kind": {
                                                                                  "Int": 2
                                                                                },
                                                                                "span": {
                                                                                  "start": 1189,
                                                                                  "end": 1190
                                                                                }
                                                                              }
                                                                            }
                                                                          },
                                                                          "span": {
                                                                            "start": 1183,
                                                                            "end": 1190
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
                                                                                      "start": 1217,
                                                                                      "end": 1218
                                                                                    }
                                                                                  }
                                                                                },
                                                                                "span": {
                                                                                  "start": 1210,
                                                                                  "end": 1219
                                                                                }
                                                                              }
                                                                            ]
                                                                          },
                                                                          "span": {
                                                                            "start": 1192,
                                                                            "end": 1233
                                                                          }
                                                                        },
                                                                        "elseif_branches": [],
                                                                        "else_branch": null
                                                                      }
                                                                    },
                                                                    "span": {
                                                                      "start": 1179,
                                                                      "end": 1233
                                                                    }
                                                                  }
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 1119,
                                                                "end": 1233
                                                              }
                                                            },
                                                            {
                                                              "kind": {
                                                                "Label": {
                                                                  "name": "L0",
                                                                  "span": {
                                                                    "start": 1234,
                                                                    "end": 1236
                                                                  }
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 1234,
                                                                "end": 1237
                                                              }
                                                            },
                                                            {
                                                              "kind": {
                                                                "Switch": {
                                                                  "expr": {
                                                                    "kind": {
                                                                      "Variable": "x"
                                                                    },
                                                                    "span": {
                                                                      "start": 1258,
                                                                      "end": 1260
                                                                    }
                                                                  },
                                                                  "cases": [
                                                                    {
                                                                      "value": {
                                                                        "kind": {
                                                                          "Int": 4
                                                                        },
                                                                        "span": {
                                                                          "start": 1285,
                                                                          "end": 1286
                                                                        }
                                                                      },
                                                                      "body": [
                                                                        {
                                                                          "kind": {
                                                                            "Break": null
                                                                          },
                                                                          "span": {
                                                                            "start": 1288,
                                                                            "end": 1294
                                                                          }
                                                                        }
                                                                      ],
                                                                      "span": {
                                                                        "start": 1280,
                                                                        "end": 1294
                                                                      }
                                                                    },
                                                                    {
                                                                      "value": {
                                                                        "kind": {
                                                                          "Int": 6
                                                                        },
                                                                        "span": {
                                                                          "start": 1316,
                                                                          "end": 1317
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
                                                                                "start": 1325,
                                                                                "end": 1326
                                                                              }
                                                                            }
                                                                          },
                                                                          "span": {
                                                                            "start": 1319,
                                                                            "end": 1327
                                                                          }
                                                                        }
                                                                      ],
                                                                      "span": {
                                                                        "start": 1311,
                                                                        "end": 1327
                                                                      }
                                                                    },
                                                                    {
                                                                      "value": {
                                                                        "kind": {
                                                                          "Int": 8
                                                                        },
                                                                        "span": {
                                                                          "start": 1349,
                                                                          "end": 1350
                                                                        }
                                                                      },
                                                                      "body": [
                                                                        {
                                                                          "kind": {
                                                                            "Goto": {
                                                                              "name": "L0",
                                                                              "span": {
                                                                                "start": 1357,
                                                                                "end": 1359
                                                                              }
                                                                            }
                                                                          },
                                                                          "span": {
                                                                            "start": 1352,
                                                                            "end": 1360
                                                                          }
                                                                        }
                                                                      ],
                                                                      "span": {
                                                                        "start": 1344,
                                                                        "end": 1360
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
                                                                            "start": 1386,
                                                                            "end": 1393
                                                                          }
                                                                        }
                                                                      ],
                                                                      "span": {
                                                                        "start": 1377,
                                                                        "end": 1393
                                                                      }
                                                                    }
                                                                  ]
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 1250,
                                                                "end": 1407
                                                              }
                                                            }
                                                          ],
                                                          "attributes": []
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 1075,
                                                        "end": 1417
                                                      }
                                                    }
                                                  ],
                                                  "attributes": []
                                                }
                                              },
                                              "span": {
                                                "start": 1057,
                                                "end": 1423
                                              }
                                            },
                                            {
                                              "kind": {
                                                "Class": {
                                                  "name": {
                                                    "name": "B",
                                                    "span": {
                                                      "start": 1434,
                                                      "end": 1435
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
                                                                "start": 1450,
                                                                "end": 1452
                                                              }
                                                            },
                                                            {
                                                              "parts": [
                                                                "T2"
                                                              ],
                                                              "kind": "Unqualified",
                                                              "span": {
                                                                "start": 1454,
                                                                "end": 1456
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
                                                                      "start": 1471,
                                                                      "end": 1473
                                                                    }
                                                                  },
                                                                  "method": {
                                                                    "parts": [
                                                                      "foo"
                                                                    ],
                                                                    "kind": "Unqualified",
                                                                    "span": {
                                                                      "start": 1475,
                                                                      "end": 1478
                                                                    }
                                                                  },
                                                                  "insteadof": [
                                                                    {
                                                                      "parts": [
                                                                        "foo"
                                                                      ],
                                                                      "kind": "Unqualified",
                                                                      "span": {
                                                                        "start": 1489,
                                                                        "end": 1492
                                                                      }
                                                                    }
                                                                  ]
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 1471,
                                                                "end": 1493
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
                                                                      "start": 1506,
                                                                      "end": 1508
                                                                    }
                                                                  },
                                                                  "method": {
                                                                    "parts": [
                                                                      "foo"
                                                                    ],
                                                                    "kind": "Unqualified",
                                                                    "span": {
                                                                      "start": 1510,
                                                                      "end": 1513
                                                                    }
                                                                  },
                                                                  "new_modifier": null,
                                                                  "new_name": {
                                                                    "parts": [
                                                                      "bar"
                                                                    ],
                                                                    "kind": "Unqualified",
                                                                    "span": {
                                                                      "start": 1517,
                                                                      "end": 1520
                                                                    }
                                                                  }
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 1506,
                                                                "end": 1521
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
                                                                      "start": 1534,
                                                                      "end": 1537
                                                                    }
                                                                  },
                                                                  "new_modifier": "Protected",
                                                                  "new_name": {
                                                                    "parts": [
                                                                      "x"
                                                                    ],
                                                                    "kind": "Unqualified",
                                                                    "span": {
                                                                      "start": 1551,
                                                                      "end": 1552
                                                                    }
                                                                  }
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 1534,
                                                                "end": 1553
                                                              }
                                                            }
                                                          ]
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 1446,
                                                        "end": 1563
                                                      }
                                                    }
                                                  ],
                                                  "attributes": []
                                                }
                                              },
                                              "span": {
                                                "start": 1428,
                                                "end": 1569
                                              }
                                            },
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
                                                          "start": 1584,
                                                          "end": 1585
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
                                                          "start": 1588,
                                                          "end": 1589
                                                        }
                                                      }
                                                    ]
                                                  ],
                                                  "body": null
                                                }
                                              },
                                              "span": {
                                                "start": 1574,
                                                "end": 1591
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
                                                                  "start": 1610,
                                                                  "end": 1612
                                                                }
                                                              },
                                                              "op": "PostIncrement"
                                                            }
                                                          },
                                                          "span": {
                                                            "start": 1610,
                                                            "end": 1614
                                                          }
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 1610,
                                                        "end": 1615
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
                                                            "start": 1629,
                                                            "end": 1640
                                                          }
                                                        }
                                                      ],
                                                      "var": {
                                                        "name": "e",
                                                        "span": {
                                                          "start": 1641,
                                                          "end": 1643
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
                                                                  "start": 1660,
                                                                  "end": 1661
                                                                }
                                                              }
                                                            ]
                                                          },
                                                          "span": {
                                                            "start": 1655,
                                                            "end": 1662
                                                          }
                                                        }
                                                      ],
                                                      "span": {
                                                        "start": 1622,
                                                        "end": 1668
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
                                                              "start": 1692,
                                                              "end": 1693
                                                            }
                                                          }
                                                        ]
                                                      },
                                                      "span": {
                                                        "start": 1687,
                                                        "end": 1694
                                                      }
                                                    }
                                                  ]
                                                }
                                              },
                                              "span": {
                                                "start": 1596,
                                                "end": 1700
                                              }
                                            }
                                          ],
                                          "attributes": []
                                        }
                                      },
                                      "span": {
                                        "start": 1020,
                                        "end": 1702
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 1015,
                                  "end": 1702
                                }
                              }
                            },
                            "span": {
                              "start": 1014,
                              "end": 1703
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 1009,
                        "end": 1703
                      }
                    }
                  },
                  "span": {
                    "start": 1009,
                    "end": 1703
                  }
                }
              ]
            }
          },
          "span": {
            "start": 1002,
            "end": 1704
          }
        }
      },
      "span": {
        "start": 1002,
        "end": 1705
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
                      "assert"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 1707,
                      "end": 1713
                    }
                  }
                },
                "span": {
                  "start": 1707,
                  "end": 1713
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
                              "start": 1714,
                              "end": 1715
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
                                        "start": 1720,
                                        "end": 1722
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
                                                      "start": 1739,
                                                      "end": 1745
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 1739,
                                                  "end": 1745
                                                }
                                              }
                                            },
                                            "span": {
                                              "start": 1738,
                                              "end": 1745
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
                                                          "start": 1762,
                                                          "end": 1763
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
                                                                  "start": 1772,
                                                                  "end": 1773
                                                                }
                                                              }
                                                            ]
                                                          },
                                                          "span": {
                                                            "start": 1767,
                                                            "end": 1774
                                                          }
                                                        }
                                                      ]
                                                    },
                                                    "span": {
                                                      "start": 1765,
                                                      "end": 1776
                                                    }
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 1752,
                                                "end": 1776
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
                                                          "start": 1781,
                                                          "end": 1783
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
                                                                  "start": 1791,
                                                                  "end": 1793
                                                                }
                                                              }
                                                            }
                                                          ]
                                                        },
                                                        "span": {
                                                          "start": 1786,
                                                          "end": 1794
                                                        }
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 1781,
                                                    "end": 1794
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 1781,
                                                "end": 1795
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
                                                          "start": 1800,
                                                          "end": 1802
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
                                                                  "start": 1806,
                                                                  "end": 1810
                                                                }
                                                              }
                                                            },
                                                            {
                                                              "Literal": "b"
                                                            }
                                                          ]
                                                        },
                                                        "span": {
                                                          "start": 1805,
                                                          "end": 1812
                                                        }
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 1800,
                                                    "end": 1812
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 1800,
                                                "end": 1813
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
                                                          "start": 1818,
                                                          "end": 1820
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
                                                                        "start": 1826,
                                                                        "end": 1830
                                                                      }
                                                                    },
                                                                    "property": {
                                                                      "kind": {
                                                                        "Identifier": "bar"
                                                                      },
                                                                      "span": {
                                                                        "start": 1832,
                                                                        "end": 1835
                                                                      }
                                                                    }
                                                                  }
                                                                },
                                                                "span": {
                                                                  "start": 1826,
                                                                  "end": 1835
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
                                                                            "start": 1839,
                                                                            "end": 1843
                                                                          }
                                                                        },
                                                                        "property": {
                                                                          "kind": {
                                                                            "Identifier": "bar"
                                                                          },
                                                                          "span": {
                                                                            "start": 1845,
                                                                            "end": 1848
                                                                          }
                                                                        }
                                                                      }
                                                                    },
                                                                    "span": {
                                                                      "start": 1839,
                                                                      "end": 1848
                                                                    }
                                                                  }
                                                                },
                                                                "span": {
                                                                  "start": 1837,
                                                                  "end": 1849
                                                                }
                                                              }
                                                            },
                                                            {
                                                              "Literal": " "
                                                            }
                                                          ]
                                                        },
                                                        "span": {
                                                          "start": 1823,
                                                          "end": 1851
                                                        }
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 1818,
                                                    "end": 1851
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 1818,
                                                "end": 1852
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
                                                          "start": 1857,
                                                          "end": 1859
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
                                                              "start": 1862,
                                                              "end": 1875
                                                            }
                                                          }
                                                        },
                                                        "span": {
                                                          "start": 1862,
                                                          "end": 1875
                                                        }
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 1857,
                                                    "end": 1875
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 1857,
                                                "end": 1876
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
                                                          "start": 1881,
                                                          "end": 1883
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
                                                                    "start": 1890,
                                                                    "end": 1903
                                                                  }
                                                                }
                                                              },
                                                              "span": {
                                                                "start": 1890,
                                                                "end": 1903
                                                              }
                                                            },
                                                            "args": []
                                                          }
                                                        },
                                                        "span": {
                                                          "start": 1886,
                                                          "end": 1905
                                                        }
                                                      }
                                                    }
                                                  },
                                                  "span": {
                                                    "start": 1881,
                                                    "end": 1905
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 1881,
                                                "end": 1906
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
                                                      "start": 1915,
                                                      "end": 1917
                                                    }
                                                  },
                                                  "then_branch": {
                                                    "kind": {
                                                      "Block": []
                                                    },
                                                    "span": {
                                                      "start": 1919,
                                                      "end": 1926
                                                    }
                                                  },
                                                  "elseif_branches": [
                                                    {
                                                      "condition": {
                                                        "kind": {
                                                          "Variable": "b"
                                                        },
                                                        "span": {
                                                          "start": 1935,
                                                          "end": 1937
                                                        }
                                                      },
                                                      "body": {
                                                        "kind": {
                                                          "Block": []
                                                        },
                                                        "span": {
                                                          "start": 1939,
                                                          "end": 1946
                                                        }
                                                      },
                                                      "span": {
                                                        "start": 1927,
                                                        "end": 1946
                                                      }
                                                    }
                                                  ],
                                                  "else_branch": null
                                                }
                                              },
                                              "span": {
                                                "start": 1911,
                                                "end": 1946
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
                                                      "start": 1955,
                                                      "end": 1957
                                                    }
                                                  },
                                                  "then_branch": {
                                                    "kind": "Nop",
                                                    "span": {
                                                      "start": 1958,
                                                      "end": 1959
                                                    }
                                                  },
                                                  "elseif_branches": [],
                                                  "else_branch": {
                                                    "kind": "Nop",
                                                    "span": {
                                                      "start": 1964,
                                                      "end": 1965
                                                    }
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 1951,
                                                "end": 1965
                                              }
                                            }
                                          ],
                                          "attributes": []
                                        }
                                      },
                                      "span": {
                                        "start": 1725,
                                        "end": 1967
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 1720,
                                  "end": 1967
                                }
                              }
                            },
                            "span": {
                              "start": 1719,
                              "end": 1968
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 1714,
                        "end": 1968
                      }
                    }
                  },
                  "span": {
                    "start": 1714,
                    "end": 1968
                  }
                }
              ]
            }
          },
          "span": {
            "start": 1707,
            "end": 1969
          }
        }
      },
      "span": {
        "start": 1707,
        "end": 1970
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 1970
  }
}
