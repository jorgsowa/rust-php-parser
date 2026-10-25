===source===
<?php
const A = (0)(...);
class B {
    const C = ((1.5))(...);
}
function f($a = (0)(...)) {}
===errors <=8.0===
'first-class callable syntax' requires PHP 8.1 or higher
'first-class callables in constant expressions' requires PHP 8.5 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'first-class callables in constant expressions' requires PHP 8.5 or higher
'first-class callable syntax' requires PHP 8.1 or higher
'first-class callables in constant expressions' requires PHP 8.5 or higher
===errors 8.1-8.4===
'first-class callables in constant expressions' requires PHP 8.5 or higher
'first-class callables in constant expressions' requires PHP 8.5 or higher
'first-class callables in constant expressions' requires PHP 8.5 or higher
===errors >=8.5===
Illegal function name
Illegal function name
Illegal function name
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ')' in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token ")" in Standard input code on line 2
===php_error 8.1-8.4===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Illegal function name in Standard input code on line 2
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
                "CallableCreate": {
                  "kind": {
                    "Function": {
                      "kind": {
                        "Parenthesized": {
                          "kind": {
                            "Int": 0
                          },
                          "span": {
                            "start": 17,
                            "end": 18
                          }
                        }
                      },
                      "span": {
                        "start": 16,
                        "end": 19
                      }
                    }
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 24
              }
            },
            "attributes": [],
            "span": {
              "start": 12,
              "end": 24
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 25
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "B",
            "span": {
              "start": 32,
              "end": 33
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
                "ClassConst": {
                  "name": {
                    "name": "C",
                    "span": {
                      "start": 46,
                      "end": 47
                    }
                  },
                  "value": {
                    "kind": {
                      "CallableCreate": {
                        "kind": {
                          "Function": {
                            "kind": {
                              "Parenthesized": {
                                "kind": {
                                  "Parenthesized": {
                                    "kind": {
                                      "Float": 1.5
                                    },
                                    "span": {
                                      "start": 52,
                                      "end": 55
                                    }
                                  }
                                },
                                "span": {
                                  "start": 51,
                                  "end": 56
                                }
                              }
                            },
                            "span": {
                              "start": 50,
                              "end": 57
                            }
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 50,
                      "end": 62
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 40,
                "end": 63
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 26,
        "end": 65
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 75,
              "end": 76
            }
          },
          "params": [
            {
              "name": {
                "name": "a",
                "span": {
                  "start": 77,
                  "end": 79
                }
              },
              "type_hint": null,
              "default": {
                "kind": {
                  "CallableCreate": {
                    "kind": {
                      "Function": {
                        "kind": {
                          "Parenthesized": {
                            "kind": {
                              "Int": 0
                            },
                            "span": {
                              "start": 83,
                              "end": 84
                            }
                          }
                        },
                        "span": {
                          "start": 82,
                          "end": 85
                        }
                      }
                    }
                  }
                },
                "span": {
                  "start": 82,
                  "end": 90
                }
              },
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 77,
                "end": 90
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
        "start": 66,
        "end": 94
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 94
  }
}
