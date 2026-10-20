===source===
<?php
class A { public int $x { set(string $v) {} } }
===errors >=8.5===
Type of parameter $v of hook A::$x::set must be compatible with property type
===php_error <=8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  Type of parameter $v of hook A::$x::set must be compatible with property type in Standard input code on line 2
===ast >=8.5===
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
                              "start": 43,
                              "end": 45
                            }
                          },
                          "type_hint": {
                            "kind": {
                              "Named": {
                                "parts": [
                                  "string"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 36,
                                  "end": 42
                                }
                              }
                            },
                            "span": {
                              "start": 36,
                              "end": 42
                            }
                          },
                          "default": null,
                          "by_ref": false,
                          "variadic": false,
                          "attributes": [],
                          "span": {
                            "start": 36,
                            "end": 45
                          }
                        }
                      ],
                      "attributes": [],
                      "span": {
                        "start": 32,
                        "end": 49
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 16,
                "end": 51
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 53
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 53
  }
}
