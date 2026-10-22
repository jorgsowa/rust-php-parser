===source===
<?php
class A { public int $x { set(...$a) {} } }
===errors <=8.3===
'property hooks' requires PHP 8.4 or higher
Parameter $a of set hook A::$x must not be variadic
Type of parameter $a of hook A::$x::set must be compatible with property type
===errors >=8.4===
Parameter $a of set hook A::$x must not be variadic
Type of parameter $a of hook A::$x::set must be compatible with property type
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{', expecting ';' or ',' in Standard input code on line 2
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  Parameter $a of set hook A::$x must not be variadic in Standard input code on line 2
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
                              "start": 39,
                              "end": 41
                            }
                          },
                          "type_hint": null,
                          "default": null,
                          "by_ref": false,
                          "variadic": true,
                          "attributes": [],
                          "span": {
                            "start": 36,
                            "end": 41
                          }
                        }
                      ],
                      "attributes": [],
                      "span": {
                        "start": 32,
                        "end": 45
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 16,
                "end": 47
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 49
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 49
  }
}
