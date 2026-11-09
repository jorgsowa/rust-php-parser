===source===
<?php
$a = new class {
    function f(self&B $x) {}
};
===errors <=8.0===
'intersection types' requires PHP 8.1 or higher
Type self cannot be part of an intersection type
===errors >=8.1===
Type self cannot be part of an intersection type
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'B' (T_STRING), expecting variable (T_VARIABLE) in Standard input code on line 3
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "B", expecting variable in Standard input code on line 3
===php_error >=8.1===
PHP Fatal error:  Type self cannot be part of an intersection type in Standard input code on line 3
===ast===
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
                  "start": 6,
                  "end": 8
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
                          "members": [
                            {
                              "kind": {
                                "Method": {
                                  "name": {
                                    "name": "f",
                                    "span": {
                                      "start": 36,
                                      "end": 37
                                    }
                                  },
                                  "by_ref": false,
                                  "params": [
                                    {
                                      "name": {
                                        "name": "x",
                                        "span": {
                                          "start": 45,
                                          "end": 47
                                        }
                                      },
                                      "type_hint": {
                                        "kind": {
                                          "Intersection": [
                                            {
                                              "kind": {
                                                "Named": {
                                                  "parts": [
                                                    "self"
                                                  ],
                                                  "kind": "Unqualified",
                                                  "span": {
                                                    "start": 38,
                                                    "end": 42
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 38,
                                                "end": 42
                                              }
                                            },
                                            {
                                              "kind": {
                                                "Named": {
                                                  "parts": [
                                                    "B"
                                                  ],
                                                  "kind": "Unqualified",
                                                  "span": {
                                                    "start": 43,
                                                    "end": 44
                                                  }
                                                }
                                              },
                                              "span": {
                                                "start": 43,
                                                "end": 44
                                              }
                                            }
                                          ]
                                        },
                                        "span": {
                                          "start": 38,
                                          "end": 44
                                        }
                                      },
                                      "default": null,
                                      "by_ref": false,
                                      "variadic": false,
                                      "attributes": [],
                                      "span": {
                                        "start": 38,
                                        "end": 47
                                      }
                                    }
                                  ],
                                  "return_type": null,
                                  "body": [],
                                  "attributes": []
                                }
                              },
                              "span": {
                                "start": 27,
                                "end": 51
                              }
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 53
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 53
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 53
          }
        }
      },
      "span": {
        "start": 6,
        "end": 54
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 54
  }
}
