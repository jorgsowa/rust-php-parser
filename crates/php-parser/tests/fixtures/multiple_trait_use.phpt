===source===
<?php
class Service {
    use Loggable, Cacheable, Serializable;
    public function run(): void {}
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Service",
            "span": {
              "start": 12,
              "end": 19
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
                        "Loggable"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 30,
                        "end": 38
                      }
                    },
                    {
                      "parts": [
                        "Cacheable"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 40,
                        "end": 49
                      }
                    },
                    {
                      "parts": [
                        "Serializable"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 51,
                        "end": 63
                      }
                    }
                  ],
                  "adaptations": []
                }
              },
              "span": {
                "start": 26,
                "end": 64
              }
            },
            {
              "kind": {
                "Method": {
                  "name": {
                    "name": "run",
                    "span": {
                      "start": 85,
                      "end": 88
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "void"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 92,
                          "end": 96
                        }
                      }
                    },
                    "span": {
                      "start": 92,
                      "end": 96
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 69,
                "end": 99
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 101
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 101
  }
}
