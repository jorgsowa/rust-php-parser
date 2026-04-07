===source===
<?php for (;;) { break; }
===ast===
{
  "stmts": [
    {
      "kind": {
        "For": {
          "init": [],
          "condition": [],
          "update": [],
          "body": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Break": null
                  },
                  "span": {
                    "start": 17,
                    "end": 24
                  }
                }
              ]
            },
            "span": {
              "start": 15,
              "end": 25
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}
