===description===
Holds a single class keyword reference, so no other one turns the check on.
===source===
<?php class A extends B { function f() { $g = parent::$a::get(...); } }
===errors <=8.0===
'first-class callable syntax' requires PHP 8.1 or higher
===errors >=8.4===
Cannot create Closure for parent property hook call
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ')' in Standard input code on line 1
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token ")" in Standard input code on line 1
===php_error >=8.4===
PHP Fatal error:  Cannot create Closure for parent property hook call in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": {
            "parts": [
              "B"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 22,
              "end": 23
            }
          },
          "implements": [],
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "f",
                    "span": {
                      "start": 35,
                      "end": 36
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [
                    {
                      "kind": {
                        "Expression": {
                          "kind": {
                            "Assign": {
                              "target": {
                                "kind": {
                                  "Variable": "g"
                                },
                                "span": {
                                  "start": 41,
                                  "end": 43
                                }
                              },
                              "op": "Assign",
                              "value": {
                                "kind": {
                                  "CallableCreate": {
                                    "kind": {
                                      "StaticMethod": {
                                        "class": {
                                          "kind": {
                                            "StaticPropertyAccess": {
                                              "class": {
                                                "kind": {
                                                  "Name": {
                                                    "parts": [
                                                      "parent"
                                                    ],
                                                    "kind": "Unqualified",
                                                    "span": {
                                                      "start": 46,
                                                      "end": 52
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 46,
                                                  "end": 52
                                                }
                                              },
                                              "member": {
                                                "kind": {
                                                  "Identifier": "a"
                                                },
                                                "span": {
                                                  "start": 54,
                                                  "end": 56
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 46,
                                            "end": 56
                                          }
                                        },
                                        "method": {
                                          "kind": {
                                            "Identifier": "get"
                                          },
                                          "span": {
                                            "start": 58,
                                            "end": 61
                                          }
                                        }
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 46,
                                  "end": 66
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 41,
                            "end": 66
                          }
                        }
                      },
                      "span": {
                        "start": 41,
                        "end": 67
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 26,
                "end": 69
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 71
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 71
  }
}
