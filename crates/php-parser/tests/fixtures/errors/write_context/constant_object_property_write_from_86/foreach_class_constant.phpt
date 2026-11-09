===source===
<?php
foreach ($b as E::A->p) {}
===errors <=7.4===
'class constant dereferencing' requires PHP 8.0 or higher
Cannot use temporary expression in write context
===errors 8.0-8.5===
Cannot use temporary expression in write context
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '->' (T_OBJECT_OPERATOR), expecting '[' in Standard input code on line 2
===php_error 8.0-8.5===
PHP Fatal error:  Cannot use temporary expression in write context in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "b"
            },
            "span": {
              "start": 15,
              "end": 17
            }
          },
          "key": null,
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
                              "start": 21,
                              "end": 22
                            }
                          }
                        },
                        "span": {
                          "start": 21,
                          "end": 22
                        }
                      },
                      "member": {
                        "kind": {
                          "Identifier": "A"
                        },
                        "span": {
                          "start": 24,
                          "end": 25
                        }
                      }
                    }
                  },
                  "span": {
                    "start": 21,
                    "end": 25
                  }
                },
                "property": {
                  "kind": {
                    "Identifier": "p"
                  },
                  "span": {
                    "start": 27,
                    "end": 28
                  }
                }
              }
            },
            "span": {
              "start": 21,
              "end": 28
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 30,
              "end": 32
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}
