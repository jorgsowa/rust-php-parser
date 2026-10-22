===source===
<?php class A { private const string Y = 'a'; }
===errors <=8.2===
'typed class constants' requires PHP 8.3 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'Y' (T_STRING), expecting '=' in Standard input code on line 1
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected identifier "Y", expecting "=" in Standard input code on line 1
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
                    "name": "Y",
                    "span": {
                      "start": 37,
                      "end": 38
                    }
                  },
                  "modifiers": {
                    "visibility": "Private"
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 30,
                          "end": 36
                        }
                      }
                    },
                    "span": {
                      "start": 30,
                      "end": 36
                    }
                  },
                  "value": {
                    "kind": {
                      "String": "a"
                    },
                    "span": {
                      "start": 41,
                      "end": 44
                    }
                  },
                  "attributes": []
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
