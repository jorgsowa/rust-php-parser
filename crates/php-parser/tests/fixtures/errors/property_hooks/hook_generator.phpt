===source===
<?php
class A { public int $x { get { yield 1; } } }
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
Generator return type must be a supertype of Generator, int given
===errors >=8.4===
Generator return type must be a supertype of Generator, int given
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 2
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  Generator return type must be a supertype of Generator, int given in Standard input code on line 2
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
                "Property": {
                  "name": {
                    "name": "x",
                    "span": {
                      "start": 27,
                      "end": 29
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 23,
                          "end": 26
                        }
                      }
                    },
                    "span": {
                      "start": 23,
                      "end": 26
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": {
                        "Block": [
                          {
                            "kind": {
                              "Expression": {
                                "kind": {
                                  "Yield": {
                                    "key": null,
                                    "value": {
                                      "kind": {
                                        "Int": 1
                                      },
                                      "span": {
                                        "start": 44,
                                        "end": 45
                                      }
                                    },
                                    "is_from": false
                                  }
                                },
                                "span": {
                                  "start": 38,
                                  "end": 45
                                }
                              }
                            },
                            "span": {
                              "start": 38,
                              "end": 46
                            }
                          }
                        ]
                      },
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 32,
                        "end": 48
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 16,
                "end": 50
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 52
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 52
  }
}
