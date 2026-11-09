===source===
<?php trait A { public function m() {} } class C { use A { m invalid; } }
===errors===
expected '::' or 'as', found identifier
expected identifier, found ';'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'invalid' (T_STRING), expecting :: (T_PAAMAYIM_NEKUDOTAYIM) in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected identifier "invalid", expecting "::" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "members": [
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 32,
                      "end": 33
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": null,
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 38
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 40
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 47,
              "end": 48
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
                "TraitUse": {
                  "traits": [
                    {
                      "parts": [
                        "A"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 55,
                        "end": 56
                      }
                    }
                  ],
                  "adaptations": []
                }
              },
              "span": {
                "start": 51,
                "end": 71
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 41,
        "end": 73
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 73
  }
}
