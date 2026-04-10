===source===
<?php interface Foo { const X = ; } class Baz {}
===errors===
expected expression
===ast===
{
  "stmts": [
    {
      "kind": {
        "Interface": {
          "name": "Foo",
          "extends": [],
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": "X",
                  "visibility": null,
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
          "name": "Baz",
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
