===config===
min_php=8.3
===source===
<?php class A { private const string Y = 'a'; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": "A",
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
                  "name": "Y",
                  "visibility": "Private",
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
                "end": 46
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
