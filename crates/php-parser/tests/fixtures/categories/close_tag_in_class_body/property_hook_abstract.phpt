===source===
<?php abstract class A { abstract public int $a { get ?><?php } }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 21,
              "end": 22
            }
          },
          "modifiers": {
            "is_abstract": true,
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
                    "name": "a",
                    "span": {
                      "start": 45,
                      "end": 47
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_abstract": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 41,
                          "end": 44
                        }
                      }
                    },
                    "span": {
                      "start": 41,
                      "end": 44
                    }
                  },
                  "default": null,
                  "attributes": [],
                  "hooks": [
                    {
                      "kind": "Get",
                      "body": "Abstract",
                      "by_ref": false,
                      "params": [],
                      "attributes": [],
                      "span": {
                        "start": 50,
                        "end": 61
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 25,
                "end": 63
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 15,
        "end": 65
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 65
  }
}
