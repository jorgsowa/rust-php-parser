===source===
<?php
const T = E::A->$x;
===errors <=7.4===
'class constant dereferencing' requires PHP 8.0 or higher
'property fetch in constant expressions' requires PHP 8.2 or higher
===errors 8.0-8.1===
'property fetch in constant expressions' requires PHP 8.2 or higher
===errors >=8.2===
Constant expression contains invalid operations
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '->' (T_OBJECT_OPERATOR), expecting ';' or ',' in Standard input code on line 2
===php_error >=8.0===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Const": [
          {
            "name": {
              "name": "T",
              "span": {
                "start": 12,
                "end": 13
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
                                "start": 16,
                                "end": 17
                              }
                            }
                          },
                          "span": {
                            "start": 16,
                            "end": 17
                          }
                        },
                        "member": {
                          "kind": {
                            "Identifier": "A"
                          },
                          "span": {
                            "start": 19,
                            "end": 20
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 16,
                      "end": 20
                    }
                  },
                  "property": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 22,
                      "end": 24
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
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}
