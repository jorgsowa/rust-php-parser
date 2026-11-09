===source===
<?php
class C {
    public function k(): static&A {}
}
===errors <=7.4===
'static type' requires PHP 8.0 or higher
'intersection types' requires PHP 8.1 or higher
Type static cannot be part of an intersection type
===errors 8.0===
'intersection types' requires PHP 8.1 or higher
Type static cannot be part of an intersection type
===errors >=8.1===
Type static cannot be part of an intersection type
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'static' (T_STATIC) in Standard input code on line 3
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token "&", expecting ";" or "{" in Standard input code on line 3
===php_error >=8.1===
PHP Fatal error:  Type static cannot be part of an intersection type in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
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
                "Method": {
                  "name": {
                    "name": "k",
                    "span": {
                      "start": 36,
                      "end": 37
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Intersection": [
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "static"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 41,
                                "end": 47
                              }
                            }
                          },
                          "span": {
                            "start": 41,
                            "end": 47
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "A"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 48,
                                "end": 49
                              }
                            }
                          },
                          "span": {
                            "start": 48,
                            "end": 49
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 41,
                      "end": 49
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 52
              }
            }
          ],
          "attributes": []
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
