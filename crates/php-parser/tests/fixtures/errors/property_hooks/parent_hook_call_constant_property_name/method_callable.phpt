===source===
<?php
class A extends B {
    function m() {
        $f = parent::${"a"}::get(...);
    }
}
===errors <=8.0===
'first-class callable syntax' requires PHP 8.1 or higher
===errors >=8.4===
Cannot create Closure for parent property hook call
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ')' in Standard input code on line 4
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token ")" in Standard input code on line 4
===php_error >=8.4===
PHP Fatal error:  Cannot create Closure for parent property hook call in Standard input code on line 4
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
                    "name": "m",
                    "span": {
                      "start": 39,
                      "end": 40
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
                                  "Variable": "f"
                                },
                                "span": {
                                  "start": 53,
                                  "end": 55
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
                                            "StaticPropertyAccessDynamic": {
                                              "class": {
                                                "kind": {
                                                  "Name": {
                                                    "parts": [
                                                      "parent"
                                                    ],
                                                    "kind": "Unqualified",
                                                    "span": {
                                                      "start": 58,
                                                      "end": 64
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 58,
                                                  "end": 64
                                                }
                                              },
                                              "member": {
                                                "kind": {
                                                  "VariableVariable": {
                                                    "kind": {
                                                      "String": "a"
                                                    },
                                                    "span": {
                                                      "start": 68,
                                                      "end": 71
                                                    }
                                                  }
                                                },
                                                "span": {
                                                  "start": 66,
                                                  "end": 72
                                                }
                                              }
                                            }
                                          },
                                          "span": {
                                            "start": 58,
                                            "end": 72
                                          }
                                        },
                                        "method": {
                                          "kind": {
                                            "Identifier": "get"
                                          },
                                          "span": {
                                            "start": 74,
                                            "end": 77
                                          }
                                        }
                                      }
                                    }
                                  }
                                },
                                "span": {
                                  "start": 58,
                                  "end": 82
                                }
                              }
                            }
                          },
                          "span": {
                            "start": 53,
                            "end": 82
                          }
                        }
                      },
                      "span": {
                        "start": 53,
                        "end": 83
                      }
                    }
                  ],
                  "attributes": []
                }
              },
              "span": {
                "start": 30,
                "end": 89
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 91
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 91
  }
}
