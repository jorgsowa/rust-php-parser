===source===
<?php
class C {
    public iterable $b { set(Traversable $v) {} }
}
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
Type of parameter $v of hook C::$b::set must be compatible with property type
===errors >=8.4===
Type of parameter $v of hook C::$b::set must be compatible with property type
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Type of parameter $v of hook C::$b::set must be compatible with property type in Standard input code on line 3
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
                "Property": {
                  "name": {
                    "name": "b",
                    "span": {
                      "start": 36,
                      "end": 38
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "iterable"
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
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Set",
                      "body": {
                        "Block": []
                      },
                      "by_ref": false,
                      "params": [
                        {
                          "name": {
                            "name": "v",
                            "span": {
                              "start": 57,
                              "end": 59
                            }
                          },
                          "type_hint": {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "Traversable"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 45,
                                  "end": 56
                                }
                              }
                            },
                            "span": {
                              "start": 45,
                              "end": 56
                            }
                          },
                          "default": null,
                          "by_ref": false,
                          "variadic": false,
                          "attributes": [],
                          "span": {
                            "start": 45,
                            "end": 59
                          }
                        }
                      ],
                      "attributes": [],
                      "span": {
                        "start": 41,
                        "end": 63
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 65
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 67
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 67
  }
}
