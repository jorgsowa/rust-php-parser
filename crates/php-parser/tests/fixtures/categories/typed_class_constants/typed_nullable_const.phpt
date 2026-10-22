===source===
<?php class A { const ?string N = null; }
===errors <=8.2===
'typed class constants' requires PHP 8.3 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '?' in Standard input code on line 1
===php_error 8.0-8.2===
PHP Parse error:  syntax error, unexpected token "?" in Standard input code on line 1
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
                    "name": "N",
                    "span": {
                      "start": 30,
                      "end": 31
                    }
                  },
                  "type_hint": {
                    "kind": {
                      "Nullable": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "string"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 23,
                              "end": 29
                            }
                          }
                        },
                        "span": {
                          "start": 23,
                          "end": 29
                        }
                      }
                    },
                    "span": {
                      "start": 22,
                      "end": 29
                    }
                  },
                  "value": {
                    "kind": "Null",
                    "span": {
                      "start": 34,
                      "end": 38
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 39
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 41
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 41
  }
}
