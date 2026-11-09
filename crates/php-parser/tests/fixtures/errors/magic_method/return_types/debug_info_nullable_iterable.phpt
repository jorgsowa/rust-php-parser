===source===
<?php
class A {
    function __debugInfo(): iterable|null {}
}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
'null type' requires PHP 8.0 or higher
===errors >=8.0===
A::__debugInfo(): Return type must be ?array when declared
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting ';' or '{' in Standard input code on line 3
===php_error >=8.0===
PHP Fatal error:  A::__debugInfo(): Return type must be ?array when declared in Standard input code on line 3
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
                "Method": {
                  "name": {
                    "name": "__debugInfo",
                    "span": {
                      "start": 29,
                      "end": 40
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Union": [
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "iterable"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 44,
                                "end": 52
                              }
                            }
                          },
                          "span": {
                            "start": 44,
                            "end": 52
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "null"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 53,
                                "end": 57
                              }
                            }
                          },
                          "span": {
                            "start": 53,
                            "end": 57
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 44,
                      "end": 57
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 60
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 62
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 62
  }
}
