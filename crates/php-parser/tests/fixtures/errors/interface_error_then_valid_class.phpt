===source===
<?php interface Foo { const X = ; } class Baz {}
===errors===
expected expression
===php_error===
PHP Parse error:  syntax error, unexpected token ";" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": {
            "name": "Foo",
            "span": {
              "start": 16,
              "end": 19
            }
          },
          "extends": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 28,
                      "end": 29
                    }
                  },
                  "visibility": null,
                  "is_final": false,
                  "value": {
                    "kind": "Error",
                    "span": {
                      "start": 32,
                      "end": 33
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 22,
                "end": 33
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 35
      }
    },
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Baz",
            "span": {
              "start": 42,
              "end": 45
            }
          },
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": false
          },
          "extends": null,
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 36,
        "end": 48
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48
  }
}
