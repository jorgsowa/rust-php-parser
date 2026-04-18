===config===
min_php=8.1
===source===
<?php readonly class Foo { public string $bar; }
===errors===
'readonly class' requires PHP 8.2 or higher (targeting PHP 8.1)
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "Foo",
          "modifiers": {
            "is_abstract": false,
            "is_final": false,
            "is_readonly": true
          },
          "extends": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Property": {
                  "name": "bar",
                  "visibility": "Public",
                  "set_visibility": null,
                  "is_static": false,
                  "is_readonly": false,
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "string"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 34,
                          "end": 40
                        }
                      }
                    },
                    "span": {
                      "start": 34,
                      "end": 40
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 27,
                "end": 45
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 48
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48
  }
}
