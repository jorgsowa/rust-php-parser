===source===
<?php
class A {
    const ?callable C = null;
}
===errors <=8.2===
'typed class constants' requires PHP 8.3 or higher
Class constant A::C cannot have type ?callable
===errors >=8.3===
Class constant A::C cannot have type ?callable
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '?' in Standard input code on line 3
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected token "?" in Standard input code on line 3
===php_error >=8.3===
PHP Fatal error:  Class constant A::C cannot have type ?callable in Standard input code on line 3
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
                    "name": "C",
                    "span": {
                      "start": 36,
                      "end": 37
                    }
                  },
                  "type_hint": {
                    "kind": {
                      "Nullable": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "callable"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 27,
                              "end": 35
                            }
                          }
                        },
                        "span": {
                          "start": 27,
                          "end": 35
                        }
                      }
                    },
                    "span": {
                      "start": 26,
                      "end": 35
                    }
                  },
                  "value": {
                    "kind": "Null",
                    "span": {
                      "start": 40,
                      "end": 44
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 45
              }
            }
          ],
          "attributes": []
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
