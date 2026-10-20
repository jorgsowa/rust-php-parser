===source===
<?php
class A { public int $x { set(&$a) {} } }
===errors >=8.5===
Parameter $a of set hook A::$x must not be pass-by-reference
Type of parameter $a of hook A::$x::set must be compatible with property type
===php_error <=8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  Parameter $a of set hook A::$x must not be pass-by-reference in Standard input code on line 2
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
                            "name": "a",
                            "span": {
                              "start": 37,
                              "end": 39
                            }
                          },
                          "type_hint": null,
                          "default": null,
                          "by_ref": true,
                          "variadic": false,
                          "attributes": [],
                          "span": {
                            "start": 36,
                            "end": 39
                          }
                        }
                      ],
                      "attributes": [],
                      "span": {
                        "start": 32,
                        "end": 43
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 16,
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
