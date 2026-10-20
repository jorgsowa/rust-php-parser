===source===
<?php trait T { #[Inject] public string $dep; }
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
                "Property": {
                  "name": {
                    "name": "dep",
                    "span": {
                      "start": 40,
                      "end": 44
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
                          "start": 33,
                          "end": 39
                        }
                      }
                    },
                    "span": {
                      "start": 33,
                      "end": 39
                    }
                  },
                  "default": null,
                  "attributes": [
                    {
                      "name": {
                        "parts": [
                          "Inject"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 18,
                          "end": 24
                        }
                      },
                      "args": [],
                      "span": {
                        "start": 18,
                        "end": 24
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 16,
                "end": 44
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
