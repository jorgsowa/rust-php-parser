===source===
<?php
class A {
    const void A = 1, B = 2;
}
===errors <=8.2===
'typed class constants' requires PHP 8.3 or higher
Class constant A::A cannot have type void
===errors >=8.3===
Class constant A::A cannot have type void
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'A' (T_STRING), expecting '=' in Standard input code on line 3
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected identifier "A", expecting "=" in Standard input code on line 3
===php_error >=8.3===
PHP Fatal error:  Class constant A::A cannot have type void in Standard input code on line 3
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
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "A",
                    "span": {
                      "start": 31,
                      "end": 32
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
                          "start": 26,
                          "end": 30
                        }
                      }
                    },
                    "span": {
                      "start": 26,
                      "end": 30
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 35,
                      "end": 36
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 36
              }
            },
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "B",
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
                          "start": 26,
                          "end": 30
                        }
                      }
                    },
                    "span": {
                      "start": 26,
                      "end": 30
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 2
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
                "start": 38,
                "end": 44
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 46
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46
  }
}
