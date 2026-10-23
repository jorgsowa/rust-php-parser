===description===
#[Attribute], #[AllowDynamicProperties] and #[Deprecated] reject class-likes PHP cannot apply them to.
===source===
<?php
#[Attribute] interface I {}
#[Attribute] trait T {}
#[Attribute] enum E {}
#[Attribute] abstract class A {}
#[AllowDynamicProperties] interface J {}
#[AllowDynamicProperties] trait U {}
#[AllowDynamicProperties] enum F {}
#[AllowDynamicProperties] readonly class R {}
#[Deprecated] class C {}
#[Deprecated] abstract class D {}
#[Deprecated] interface K {}
#[Deprecated] enum G {}
$a = new #[Deprecated] class {};
$b = new #[AllowDynamicProperties] readonly class {};
===errors <=7.4===
Cannot use expression as assignment target.
expected identifier, found end of file
===errors 8.0===
'enums' requires PHP 8.1 or higher
'enums' requires PHP 8.1 or higher
'readonly class' requires PHP 8.2 or higher
'enums' requires PHP 8.1 or higher
'readonly anonymous classes' requires PHP 8.3 or higher
===errors 8.1===
'readonly class' requires PHP 8.2 or higher
'readonly anonymous classes' requires PHP 8.3 or higher
===errors 8.2===
Cannot apply #[\AllowDynamicProperties] to interface J
Cannot apply #[\AllowDynamicProperties] to trait U
Cannot apply #[\AllowDynamicProperties] to readonly class R
'readonly anonymous classes' requires PHP 8.3 or higher
Cannot apply #[\AllowDynamicProperties] to readonly class class@anonymous
===errors 8.3===
Cannot apply #[\AllowDynamicProperties] to interface J
Cannot apply #[\AllowDynamicProperties] to trait U
Cannot apply #[\AllowDynamicProperties] to readonly class R
Cannot apply #[\AllowDynamicProperties] to readonly class class@anonymous
===errors 8.4===
Cannot apply #[\AllowDynamicProperties] to interface J
Cannot apply #[\AllowDynamicProperties] to trait U
Cannot apply #[\AllowDynamicProperties] to enum F
Cannot apply #[\AllowDynamicProperties] to readonly class R
Cannot apply #[\Deprecated] to class C
Cannot apply #[\Deprecated] to class D
Cannot apply #[\Deprecated] to interface K
Cannot apply #[\Deprecated] to enum G
Cannot apply #[\Deprecated] to class class@anonymous
Cannot apply #[\AllowDynamicProperties] to readonly class class@anonymous
===errors >=8.5===
Cannot apply #[\Attribute] to interface I
Cannot apply #[\Attribute] to trait T
Cannot apply #[\Attribute] to enum E
Cannot apply #[\Attribute] to abstract class A
Cannot apply #[\AllowDynamicProperties] to interface J
Cannot apply #[\AllowDynamicProperties] to trait U
Cannot apply #[\AllowDynamicProperties] to enum F
Cannot apply #[\AllowDynamicProperties] to readonly class R
Cannot apply #[\Deprecated] to class C
Cannot apply #[\Deprecated] to class D
Cannot apply #[\Deprecated] to interface K
Cannot apply #[\Deprecated] to enum G
Cannot apply #[\Deprecated] to class class@anonymous
Cannot apply #[\AllowDynamicProperties] to readonly class class@anonymous
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '=' in Standard input code on line 15
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "enum" in Standard input code on line 4
===php_error 8.1===
PHP Parse error:  syntax error, unexpected token "readonly" in Standard input code on line 9
===php_error 8.2===
PHP Parse error:  syntax error, unexpected token "readonly", expecting "class" or "#[" in Standard input code on line 15
===php_error 8.3===
PHP Fatal error:  Cannot apply #[AllowDynamicProperties] to interface in Standard input code on line 6
===php_error 8.4===
PHP Fatal error:  Cannot apply #[AllowDynamicProperties] to interface J in Standard input code on line 6
===php_error >=8.5===
PHP Fatal error:  Cannot apply #[\Attribute] to interface I in Standard input code on line 2
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 386,
                  "end": 388
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Assign": {
                    "target": {
                      "kind": {
                        "New": {
                          "class": {
                            "kind": {
                              "Variable": "b"
                            },
                            "span": {
                              "start": 419,
                              "end": 421
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 391,
                        "end": 421
                      }
                    },
                    "op": "Assign",
                    "value": {
                      "kind": {
                        "New": {
                          "class": {
                            "kind": "Error",
                            "span": {
                              "start": 427,
                              "end": 427
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 424,
                        "end": 427
                      }
                    }
                  }
                },
                "span": {
                  "start": 391,
                  "end": 427
                }
              }
            }
          },
          "span": {
            "start": 386,
            "end": 427
          }
        }
      },
      "span": {
        "start": 386,
        "end": 427
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 427
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "I",
            "span": {
              "start": 29,
              "end": 30
            }
          },
          "extends": [],
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "Attribute"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 8,
                  "end": 17
                }
              },
              "args": [],
              "span": {
                "start": 8,
                "end": 17
              }
            }
          ]
        }
      },
      "span": {
        "start": 19,
        "end": 33
      }
    },
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 53,
              "end": 54
            }
          },
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "Attribute"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 36,
                  "end": 45
                }
              },
              "args": [],
              "span": {
                "start": 36,
                "end": 45
              }
            }
          ]
        }
      },
      "span": {
        "start": 47,
        "end": 57
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 76,
              "end": 77
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "Attribute"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 60,
                  "end": 69
                }
              },
              "args": [],
              "span": {
                "start": 60,
                "end": 69
              }
            }
          ]
        }
      },
      "span": {
        "start": 71,
        "end": 80
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 109,
              "end": 110
            }
          },
          "modifiers": {
            "is_abstract": true,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "Attribute"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 83,
                  "end": 92
                }
              },
              "args": [],
              "span": {
                "start": 83,
                "end": 92
              }
            }
          ]
        }
      },
      "span": {
        "start": 103,
        "end": 113
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "J",
            "span": {
              "start": 150,
              "end": 151
            }
          },
          "extends": [],
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "AllowDynamicProperties"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 116,
                  "end": 138
                }
              },
              "args": [],
              "span": {
                "start": 116,
                "end": 138
              }
            }
          ]
        }
      },
      "span": {
        "start": 140,
        "end": 154
      }
    },
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "U",
            "span": {
              "start": 187,
              "end": 188
            }
          },
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "AllowDynamicProperties"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 157,
                  "end": 179
                }
              },
              "args": [],
              "span": {
                "start": 157,
                "end": 179
              }
            }
          ]
        }
      },
      "span": {
        "start": 181,
        "end": 191
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "F",
            "span": {
              "start": 223,
              "end": 224
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "AllowDynamicProperties"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 194,
                  "end": 216
                }
              },
              "args": [],
              "span": {
                "start": 194,
                "end": 216
              }
            }
          ]
        }
      },
      "span": {
        "start": 218,
        "end": 227
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "R",
            "span": {
              "start": 269,
              "end": 270
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": true
          },
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "AllowDynamicProperties"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 230,
                  "end": 252
                }
              },
              "args": [],
              "span": {
                "start": 230,
                "end": 252
              }
            }
          ]
        }
      },
      "span": {
        "start": 263,
        "end": 273
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 294,
              "end": 295
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "Deprecated"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 276,
                  "end": 286
                }
              },
              "args": [],
              "span": {
                "start": 276,
                "end": 286
              }
            }
          ]
        }
      },
      "span": {
        "start": 288,
        "end": 298
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "D",
            "span": {
              "start": 328,
              "end": 329
            }
          },
          "modifiers": {
            "is_abstract": true,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "Deprecated"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 301,
                  "end": 311
                }
              },
              "args": [],
              "span": {
                "start": 301,
                "end": 311
              }
            }
          ]
        }
      },
      "span": {
        "start": 322,
        "end": 332
      }
    },
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "K",
            "span": {
              "start": 357,
              "end": 358
            }
          },
          "extends": [],
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "Deprecated"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 335,
                  "end": 345
                }
              },
              "args": [],
              "span": {
                "start": 335,
                "end": 345
              }
            }
          ]
        }
      },
      "span": {
        "start": 347,
        "end": 361
      }
    },
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "G",
            "span": {
              "start": 381,
              "end": 382
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "Deprecated"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 364,
                  "end": 374
                }
              },
              "args": [],
              "span": {
                "start": 364,
                "end": 374
              }
            }
          ]
        }
      },
      "span": {
        "start": 376,
        "end": 385
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 386,
                  "end": 388
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "AnonymousClass": {
                          "name": null,
                          "modifiers": {
                            "is_abstract": false,
                            "is_final": false,
                            "is_readonly": false
                          },
                          "extends": null,
                          "implements": [],
                          "members": [],
                          "attributes": [
                            {
                              "name": {
                                "parts": [
                                  "Deprecated"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 397,
                                  "end": 407
                                }
                              },
                              "args": [],
                              "span": {
                                "start": 397,
                                "end": 407
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 391,
                        "end": 417
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 391,
                  "end": 417
                }
              }
            }
          },
          "span": {
            "start": 386,
            "end": 417
          }
        }
      },
      "span": {
        "start": 386,
        "end": 418
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 419,
                  "end": 421
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "AnonymousClass": {
                          "name": null,
                          "modifiers": {
                            "is_abstract": false,
                            "is_final": false,
                            "is_readonly": true
                          },
                          "extends": null,
                          "implements": [],
                          "members": [],
                          "attributes": [
                            {
                              "name": {
                                "parts": [
                                  "AllowDynamicProperties"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 430,
                                  "end": 452
                                }
                              },
                              "args": [],
                              "span": {
                                "start": 430,
                                "end": 452
                              }
                            }
                          ]
                        }
                      },
                      "span": {
                        "start": 424,
                        "end": 471
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 424,
                  "end": 471
                }
              }
            }
          },
          "span": {
            "start": 419,
            "end": 471
          }
        }
      },
      "span": {
        "start": 419,
        "end": 472
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 472
  }
}
