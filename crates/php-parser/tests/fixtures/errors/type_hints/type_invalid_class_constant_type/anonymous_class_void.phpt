===source===
<?php
$g = new class {
    const void G = 1;
};
===errors <=8.2===
'typed class constants' requires PHP 8.3 or higher
Class constant class@anonymous::G cannot have type void
===errors >=8.3===
Class constant class@anonymous::G cannot have type void
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'G' (T_STRING), expecting '=' in Standard input code on line 3
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected identifier "G", expecting "=" in Standard input code on line 3
===php_error >=8.3===
PHP Fatal error:  Class constant class@anonymous::G cannot have type void in Standard input code on line 3
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
                  "Variable": "g"
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
                                "ClassConst": {
                                  "name": {
                                    "name": "G",
                                    "span": {
                                      "start": 38,
                                      "end": 39
                                    }
                                  },
                                  "type_hint": {
                                    "kind": {
                                      "Named": {
                                        "parts": [
                                          "void"
                                        ],
                                        "kind": "Unqualified",
                                        "span": {
                                          "start": 33,
                                          "end": 37
                                        }
                                      }
                                    },
                                    "span": {
                                      "start": 33,
                                      "end": 37
                                    }
                                  },
                                  "value": {
                                    "kind": {
                                      "Int": 1
                                    },
                                    "span": {
                                      "start": 42,
                                      "end": 43
                                    }
                                  },
                                  "attributes": []
                                }
                              },
                              "span": {
                                "start": 27,
                                "end": 44
                              }
                            }
                          ],
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 46
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 46
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 46
          }
        }
      },
      "span": {
        "start": 6,
        "end": 47
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 47
  }
}
