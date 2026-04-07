===source===
<?php die('error');
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Exit": {
              "kind": {
                "String": "error"
              },
              "span": {
                "start": 10,
                "end": 17
              }
            }
          },
          "span": {
            "start": 6,
            "end": 18
          }
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 19
  }
}
