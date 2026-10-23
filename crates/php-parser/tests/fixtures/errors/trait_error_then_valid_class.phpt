===source===
<?php trait T { public function } class C { use T; }
===errors===
expected method name, found '}'
expected '(', found '}'
expected variable, found '}'
expected ')', found '}'
expected ';', found '}'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '}' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "}" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "members": [
            {
              "kind": {
                "Method": {
                  "name": null,
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [
                    {
                      "name": null,
                      "type_hint": null,
                      "default": null,
                      "by_ref": false,
                      "variadic": false,
                      "attributes": [],
                      "span": {
                        "start": 31,
                        "end": 31
                      }
                    }
                  ],
                  "return_type": null,
                  "body": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 16,
                "end": 31
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 33
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
            "span": {
              "start": 40,
              "end": 41
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
                        "T"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 48,
                        "end": 49
                      }
                    }
                  ],
                  "adaptations": []
                }
              },
              "span": {
                "start": 44,
                "end": 50
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 34,
        "end": 52
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 52
  }
}
