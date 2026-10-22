===source===
<?php
const A = static function () {};
const B = strlen(...);
const C = (int) "1";
const D = E::A->value;
function f($a = new Foo) {}
===errors <=8.0===
'closures in constant expressions' requires PHP 8.5 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'first-class callables in constant expressions' requires PHP 8.5 or higher
'casts in constant expressions' requires PHP 8.5 or higher
'property fetch in constant expressions' requires PHP 8.2 or higher
'new in initializers' requires PHP 8.1 or higher
===errors 8.1===
'closures in constant expressions' requires PHP 8.5 or higher
'first-class callables in constant expressions' requires PHP 8.5 or higher
'casts in constant expressions' requires PHP 8.5 or higher
'property fetch in constant expressions' requires PHP 8.2 or higher
===errors 8.2-8.4===
'closures in constant expressions' requires PHP 8.5 or higher
'first-class callables in constant expressions' requires PHP 8.5 or higher
'casts in constant expressions' requires PHP 8.5 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ')' in Standard input code on line 3
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token ")" in Standard input code on line 3
===php_error 8.1-8.4===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "A",
              "span": {
                "start": 12,
                "end": 13
              }
            },
            "value": {
              "kind": {
                "Closure": {
                  "is_static": true,
                  "by_ref": false,
                  "params": [],
                  "use_vars": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 37
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 37
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 38
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "B",
              "span": {
                "start": 45,
                "end": 46
              }
            },
            "value": {
              "kind": {
                "CallableCreate": {
                  "kind": {
                    "Function": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "strlen"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 49,
                            "end": 55
                          }
                        }
                      },
                      "span": {
                        "start": 49,
                        "end": 55
                      }
                    }
                  }
                }
              },
              "span": {
                "start": 49,
                "end": 60
              }
            },
            "attributes": [],
            "span": {
              "start": 45,
              "end": 60
            }
          }
        ]
      },
      "span": {
        "start": 39,
        "end": 61
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "C",
              "span": {
                "start": 68,
                "end": 69
              }
            },
            "value": {
              "kind": {
                "Cast": [
                  "Int",
                  {
                    "kind": {
                      "String": "1"
                    },
                    "span": {
                      "start": 78,
                      "end": 81
                    }
                  }
                ]
              },
              "span": {
                "start": 72,
                "end": 81
              }
            },
            "attributes": [],
            "span": {
              "start": 68,
              "end": 81
            }
          }
        ]
      },
      "span": {
        "start": 62,
        "end": 82
      }
    },
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "D",
              "span": {
                "start": 89,
                "end": 90
              }
            },
            "value": {
              "kind": {
                "PropertyAccess": {
                  "object": {
                    "kind": {
                      "ClassConstAccess": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "E"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 93,
                                "end": 94
                              }
                            }
                          },
                          "span": {
                            "start": 93,
                            "end": 94
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "A"
                          },
                          "span": {
                            "start": 96,
                            "end": 97
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 93,
                      "end": 97
                    }
                  },
                  "property": {
                    "kind": {
                      "Identifier": "value"
                    },
                    "span": {
                      "start": 99,
                      "end": 104
                    }
                  }
                }
              },
              "span": {
                "start": 93,
                "end": 104
              }
            },
            "attributes": [],
            "span": {
              "start": 89,
              "end": 104
            }
          }
        ]
      },
      "span": {
        "start": 83,
        "end": 105
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 115,
              "end": 116
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 117,
                  "end": 119
                }
              },
              "type_hint": null,
              "default": {
                "kind": {
                  "New": {
                    "class": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "Foo"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 126,
                            "end": 129
                          }
                        }
                      },
                      "span": {
                        "start": 126,
                        "end": 129
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 122,
                  "end": 129
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 117,
                "end": 129
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 106,
        "end": 133
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 133
  }
}
