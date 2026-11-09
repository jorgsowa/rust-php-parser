===source===
<?php
class C {
    public self $e { set(callable $v) {} }
}
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
Type of parameter $v of hook C::$e::set must be compatible with property type
===errors >=8.4===
Type of parameter $v of hook C::$e::set must be compatible with property type
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 3
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Type of parameter $v of hook C::$e::set must be compatible with property type in Standard input code on line 3
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
                    "name": "e",
                    "span": {
                      "start": 32,
                      "end": 34
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "self"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 27,
                          "end": 31
                        }
                      }
                    },
                    "span": {
                      "start": 27,
                      "end": 31
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
                              "start": 50,
                              "end": 52
                            }
                          },
                          "type_hint": {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "callable"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 41,
                                  "end": 49
                                }
                              }
                            },
                            "span": {
                              "start": 41,
                              "end": 49
                            }
                          },
                          "default": null,
                          "by_ref": false,
                          "variadic": false,
                          "attributes": [],
                          "span": {
                            "start": 41,
                            "end": 52
                          }
                        }
                      ],
                      "attributes": [],
                      "span": {
                        "start": 37,
                        "end": 56
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 20,
                "end": 58
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 60
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 60
  }
}
