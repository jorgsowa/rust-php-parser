===source===
<?php class Foo { public const string NAME = 'foo'; }
===errors <=8.2===
'typed class constants' requires PHP 8.3 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'NAME' (T_STRING), expecting '=' in Standard input code on line 1
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected identifier "NAME", expecting "=" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Foo",
            "span": {
              "start": 12,
              "end": 15
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
                    "name": "NAME",
                    "span": {
                      "start": 38,
                      "end": 42
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 31,
                          "end": 37
                        }
                      }
                    },
                    "span": {
                      "start": 31,
                      "end": 37
                    }
                  },
                  "value": {
                    "kind": {
                      "String": "foo"
                    },
                    "span": {
                      "start": 45,
                      "end": 50
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 18,
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
