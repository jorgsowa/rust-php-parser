===source===
<?php require_once 'autoload.php';
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Include": [
              "RequireOnce",
              {
                "kind": {
                  "String": "autoload.php"
                },
                "span": {
                  "start": 19,
                  "end": 33
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 33
          }
        }
      },
      "span": {
        "start": 6,
        "end": 34
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 34
  }
}
